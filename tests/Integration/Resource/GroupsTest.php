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
        $groups->create(self::REALM, new Group(name: $importedGroupName));

        // Get all groups
        $allGroups = $groups->all(self::REALM);
        static::assertGreaterThanOrEqual(1, $allGroups->count());
        $group = $allGroups->first();
        static::assertInstanceOf(Group::class, $group);

        // Search for single (imported) group
        $importedGroup = $groups->all(self::REALM, new Criteria([
            'name' => $importedGroupName,
        ]))->first();
        static::assertInstanceOf(Group::class, $importedGroup);
        static::assertSame($importedGroupName, $importedGroup->getName());

        // Update (imported) group
        $groups->update(self::REALM, $importedGroup->getId(), $importedGroup->withName($updatedGroupName));

        // Delete (imported) user
        $groups->delete(self::REALM, $importedGroup->getId());

        try {
            $groups->get(self::REALM, $importedGroup->getId());
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
        $groups->create(self::REALM, new Group(name: $importedGroupName));
        $group = $groups->all(self::REALM)->first();
        static::assertInstanceOf(Group::class, $group);

        // Create child group
        $groups->createChild(self::REALM, new Group(name: $childGroupName), $group->getId());
        $childGroups = $groups->children(self::REALM, $group->getId());
        static::assertCount(1, $childGroups);

        $childGroup = $childGroups->first();
        static::assertInstanceOf(Group::class, $childGroup);
        static::assertSame($childGroupName, $childGroup->getName());

        // get child group by path
        $pathGroup = $groups->byPath(self::REALM, $importedGroupName . '/' . $childGroupName);
        static::assertInstanceOf(Group::class, $pathGroup);
        static::assertSame($childGroup->getId(), $pathGroup->getId());
    }
}
