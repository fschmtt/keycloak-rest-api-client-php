<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\Group
 */
class GroupTest extends TestCase
{
    public function testCanBeConstructedFromProperties(): void
    {
        $properties = [
            'access' => [
                'acl-a',
                'acl-b',
            ],
            'attributes' => [
                'attr-1',
                'attr-2',
            ],
            'clientRoles' => [
                'client-role-x',
                'client-role-y',
                'client-role-z',
            ],
            'id' => 'unique-id',
            'name' => 'unique-name',
            'path' => '/where/am/i',
            'realmRoles' => [
                'role-a',
                'role-b',
            ],
            'subGroups' => [],
        ];

        $constructedGroup = Group::from($properties);

        $builtGroup = new Group();
        foreach ($properties as $property => $value) {
            $builtGroup = $builtGroup->with($property, $value);
        }

        static::assertEquals($constructedGroup, $builtGroup);
    }
}
