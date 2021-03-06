<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\Group
 * @uses   \Fschmtt\Keycloak\Representation\Representation
 */
class GroupTest extends TestCase
{
    private Group $group;

    public function setUp(): void
    {
        $subGroup = new Group(
            access: ['acl-a', 'acl-b',],
            attributes: ['attr-1', 'attr-2',],
            clientRoles: ['client-role-x', 'client-role-y', 'client-role-z',],
            id: 'unique-id',
            name: 'unique-name',
            path: '/where/am/i',
            realmRoles: ['realm-role-a', 'realm-role-b',],
        );

        $this->group = new Group(
            access: ['acl-a', 'acl-b',],
            attributes: ['attr-1', 'attr-2',],
            clientRoles: ['client-role-x', 'client-role-y', 'client-role-z',],
            id: 'unique-id',
            name: 'unique-name',
            path: '/where/am/i',
            realmRoles: ['realm-role-a', 'realm-role-b',],
            subGroups: [$subGroup]
        );
    }

    /**
     * @dataProvider provideProperties
     */
    public function testCanBeConstructedFromProperties(array $properties): void
    {
        $constructedGroup = Group::from($properties);

        static::assertEquals($this->group, $constructedGroup);
    }

    /**
     * @dataProvider provideProperties
     */
    public function testCanBeBuilt(array $properties)
    {
        $builtGroup = new Group();

        foreach ($properties as $property => $value) {
            $builtGroup = $builtGroup->with($property, $value);
        }

        self::assertEquals($this->group, $builtGroup); // FIXME in Representation::withProperty()
    }

    public function provideProperties(): array
    {
        $group = [
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
                'realm-role-a',
                'realm-role-b',
            ],
        ];

        $group['subGroups'] = [$group];

        return [
            [
                $group,
            ]
        ];
    }
}
