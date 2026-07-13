<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Exception;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class GroupsTest extends TestCase
{
    use IntegrationTestBehaviour;

    private const REALM = 'groups-test';

    public static function setUpBeforeClass(): void
    {
        self::getKeycloak()->realms()->import(new Realm(realm: self::REALM));
    }

    public static function tearDownAfterClass(): void
    {
        self::getKeycloak()->realms()->delete(self::REALM);
    }

    public function testImportSearchUpdateDeleteGroup(): void
    {
        $groups = $this->getKeycloak()->groups();

        $importedGroupName = Uuid::uuid4()->toString();
        $updatedGroupName = Uuid::uuid4()->toString();

        // Create group
        $groups->create(new Group(name: $importedGroupName), realm: self::REALM);

        // Get all groups
        $allGroups = $groups->all(realm: self::REALM);
        static::assertGreaterThanOrEqual(1, $allGroups->count());
        $group = $allGroups->first();
        static::assertInstanceOf(Group::class, $group);

        // Search for single (imported) group
        $importedGroup = $groups->all(new Criteria([
            'name' => $importedGroupName,
        ]), realm: self::REALM)->first();
        static::assertInstanceOf(Group::class, $importedGroup);
        static::assertSame($importedGroupName, $importedGroup->getName());

        // Update (imported) group
        $groups->update($importedGroup->getId(), $importedGroup->withName($updatedGroupName), realm: self::REALM);

        // Delete (imported) user
        $groups->delete($importedGroup->getId(), realm: self::REALM);

        try {
            $groups->get($importedGroup->getId(), realm: self::REALM);
            static::fail('Group should not exist anymore');
        } catch (Exception $e) {
            static::assertSame(404, $e->getCode());
        }
    }

    public function testCreateChildGroup(): void
    {
        $this->skipIfKeycloakVersionIsLessThan('23.0.0');

        $importedGroupName = Uuid::uuid4()->toString();
        $childGroupName = Uuid::uuid4()->toString();

        $groups = $this->getKeycloak()->groups();

        // Create group
        $groups->create(new Group(name: $importedGroupName), realm: self::REALM);
        $group = $groups->all(realm: self::REALM)->first();
        static::assertInstanceOf(Group::class, $group);

        // Create child group
        $groups->createChild(new Group(name: $childGroupName), $group->getId(), realm: self::REALM);
        $childGroups = $groups->children($group->getId(), realm: self::REALM);
        static::assertCount(1, $childGroups);

        $childGroup = $childGroups->first();
        static::assertInstanceOf(Group::class, $childGroup);
        static::assertSame($childGroupName, $childGroup->getName());

        // get child group by path
        $pathGroup = $groups->byPath($importedGroupName . '/' . $childGroupName, realm: self::REALM);
        static::assertInstanceOf(Group::class, $pathGroup);
        static::assertSame($childGroup->getId(), $pathGroup->getId());
    }
}
