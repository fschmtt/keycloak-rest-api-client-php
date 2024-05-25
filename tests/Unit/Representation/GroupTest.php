<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Representation;

use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Type\Map;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Group::class)]
class GroupTest extends TestCase
{
    private Group $group;

    protected function setUp(): void
    {
        $subGroup = new Group(
            access: new Map(['acl-a', 'acl-b']),
            attributes: new Map(['attr-1', 'attr-2']),
            clientRoles: new Map(['client-role-x', 'client-role-y', 'client-role-z']),
            id: 'unique-id',
            name: 'unique-name',
            path: '/where/am/i',
            realmRoles: ['realm-role-a', 'realm-role-b'],
        );
        $subGroup->withId('unique-id');

        $this->group = new Group(
            access: new Map(['acl-a', 'acl-b']),
            attributes: new Map(['attr-1', 'attr-2']),
            clientRoles: new Map(['client-role-x', 'client-role-y', 'client-role-z']),
            id: 'unique-id',
            name: 'unique-name',
            path: '/where/am/i',
            realmRoles: ['realm-role-a', 'realm-role-b'],
            subGroups: new GroupCollection([$subGroup])
        );
        $this->group->withId('unique-id');
    }

    /**
     * @param array<string, mixed> $properties
     */
    #[DataProvider('provideProperties')]
    public function testCanBeConstructedFromProperties(array $properties): void
    {
        $constructedGroup = Group::from($properties);

        static::assertEquals($this->group, $constructedGroup);
    }

    /**
     * @param array<mixed> $properties
     */
    #[DataProvider('provideProperties')]
    public function testCanBeBuilt(array $properties): void
    {
        $builtGroup = new Group();

        foreach ($properties as $property => $value) {
            $builtGroup = $builtGroup->with($property, $value);
        }

        self::assertEquals($this->group, $builtGroup);
    }

    /**
     * @return array<mixed>
     */
    public static function provideProperties(): array
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

        return [[$group]];
    }
}
