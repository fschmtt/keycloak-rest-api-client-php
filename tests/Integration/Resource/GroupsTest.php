<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Exception;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class GroupsTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testImportSearchUpdateDeleteGroup(): void
    {
        $groups = $this->getKeycloak()->groups();

        $importedGroupName = Uuid::uuid4()->toString();
        $childGroupName = Uuid::uuid4()->toString();
        $updatedGroupName = Uuid::uuid4()->toString();

        // Create group
        $groups->create(
            'master',
            new Group(name: $importedGroupName),
        );


        // Get all groups
        $allGroups = $groups->all('master');
        static::assertGreaterThanOrEqual(1, $allGroups->count());
        $group = $allGroups->first();
        static::assertInstanceOf(Group::class, $group);

        //Creat child group
        $groups->create('master', new Group(name: $childGroupName), $group->getId());

        // Search for single (imported) group
        $importedGroup = $groups->all('master', new Criteria([
            'name' => $importedGroupName,
        ]))->first();
        static::assertInstanceOf(Group::class, $importedGroup);
        static::assertSame($importedGroupName, $importedGroup->getName());

        //get the child group
        $childGroup = $groups->children('master', $importedGroup->getId())->first();
        static::assertInstanceOf(Group::class, $childGroup);
        static::assertSame($childGroup->getName(), $childGroupName);

        // Update (imported) group
        $groups->update('master', $importedGroup->getId(), $importedGroup->withName($updatedGroupName));

        // Delete (imported) user
        $groups->delete('master', $importedGroup->getId());

        try {
            $groups->get('master', $importedGroup->getId());
            static::fail('Group should not exist anymore');
        } catch (Exception $e) {
            static::assertSame(404, $e->getCode());
        }
    }
}
