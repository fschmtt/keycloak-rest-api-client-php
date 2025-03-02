<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Exception;
use Fschmtt\Keycloak\Collection\CredentialCollection;
use Fschmtt\Keycloak\Collection\RoleCollection;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Representation\Credential;
use Fschmtt\Keycloak\Representation\Group;
use Fschmtt\Keycloak\Representation\Role;
use Fschmtt\Keycloak\Representation\User;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use GuzzleHttp\Exception\ServerException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UsersTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testImportSearchUpdateDeleteUser(): void
    {
        $resource = $this->getKeycloak()->users();
        $importedUsername = Uuid::uuid4()->toString();
        $importedFirstName = Uuid::uuid4()->toString();
        $updatedFirstName = Uuid::uuid4()->toString();

        // Get all users
        $allUsers = $resource->all('master');
        static::assertGreaterThanOrEqual(1, $allUsers->count());
        $user = $allUsers->first();
        static::assertInstanceOf(User::class, $user);

        // Create user
        $resource->create(
            'master',
            new User(firstName: $importedFirstName, username: $importedUsername),
        );

        // Search (imported) user
        $importedUser = $this->searchUserByUsername($importedUsername);
        static::assertInstanceOf(User::class, $importedUser);
        static::assertEquals($importedFirstName, $importedUser->getFirstName());

        // Get single (imported) user
        $importedUser = $resource->get('master', $importedUser->getId());
        static::assertSame($importedUsername, $importedUser->getUsername());

        // Update (imported) user
        $resource->update('master', $importedUser->getId(), $importedUser->withFirstName($updatedFirstName));

        $updatedUser = $this->searchUserByUsername($importedUsername);
        static::assertInstanceOf(User::class, $updatedUser);
        static::assertSame($updatedFirstName, $updatedUser->getFirstName());

        // Delete (imported) user
        $resource->delete('master', $updatedUser->getId());

        try {
            $resource->get('master', $updatedUser->getId());
            static::fail('User should not exist anymore');
        } catch (Exception $e) {
            static::assertSame(404, $e->getCode());
        }
    }

    public function testJoinRetrieveLeaveGroupUser(): void
    {
        $users = $this->getKeycloak()->users();
        $user = $users->all('master')->first();
        static::assertInstanceOf(User::class, $user);

        // create a temp group required for our test
        $groups = $this->getKeycloak()->groups();
        $groupName = Uuid::uuid4()->toString();
        $groups->create(
            'master',
            new Group(name: $groupName),
        );
        $group = $groups->all('master')->first();
        static::assertInstanceOf(Group::class, $group);

        // join group
        $users->joinGroup('master', $user->getId(), $group->getId());

        $userGroups = $users->retrieveGroups('master', $user->getId());
        static::assertGreaterThanOrEqual(1, $userGroups->count());
        $userFirstGroup = $userGroups->first();
        static::assertInstanceOf(Group::class, $userFirstGroup);
        static::assertSame($group->getId(), $userFirstGroup->getId());

        // get group members
        $groupMembers = $groups->members('master', $group->getId());
        static::assertSame(1, $groupMembers->count());
        static::assertInstanceOf(User::class, $groupMembers->first());
        static::assertSame($user->getId(), $groupMembers->first()->getId());

        // leave group
        $users->leaveGroup('master', $user->getId(), $group->getId());

        $userGroups = $users->retrieveGroups('master', $user->getId());
        static::assertGreaterThanOrEqual(0, $userGroups->count());

        // remove the temp group
        $groups->delete('master', $group->getId());
    }

    public function testAddRemoveRealmRoleUser(): void
    {
        try {
            // create a role required for our test
            $this->getKeycloak()->roles()->create('master', new Role(
                name: 'test-user-role',
            ));

            $users = $this->getKeycloak()->users();
            $user = $users->all('master')->first();
            static::assertInstanceOf(User::class, $user);

            // retrieve user's roles and count them
            $roles = $users->retrieveRealmRoles('master', $user->getId());
            $rolesCount = $roles->count();

            // retrieve user's available roles and count them
            $availableRoles = $users->retrieveAvailableRealmRoles('master', $user->getId());
            $availableRolesCount = $availableRoles->count();
            static::assertGreaterThanOrEqual(1, $availableRolesCount);
            $role = $availableRoles->first();
            static::assertInstanceOf(Role::class, $role);

            // add the first available role to the user
            $users->addRealmRoles('master', $user->getId(), new RoleCollection([$role]));

            $roles = $users->retrieveRealmRoles('master', $user->getId());
            static::assertEquals($rolesCount + 1, $roles->count());
            static::assertContainsEquals($role, $roles);

            $availableRoles = $users->retrieveAvailableRealmRoles('master', $user->getId());
            static::assertEquals($availableRolesCount - 1, $availableRoles->count());

            // remove the role from the user (back to the initial state)
            $users->removeRealmRoles('master', $user->getId(), new RoleCollection([$role]));

            $roles = $users->retrieveRealmRoles('master', $user->getId());
            static::assertEquals($rolesCount, $roles->count());
            static::assertNotContainsEquals($role, $roles);

            $availableRoles = $users->retrieveAvailableRealmRoles('master', $user->getId());
            static::assertEquals($availableRolesCount, $availableRoles->count());
        } finally {
            $this->getKeycloak()->roles()->delete('master', 'test-user-role');
        }
    }

    public function testCreateUserWithPasswordCredential(): void
    {
        $users = $this->getKeycloak()->users();
        $username = Uuid::uuid4()->toString();

        $users->create('master', new User(
            credentials: new CredentialCollection([$this->createPasswordCredential('p4ssw0rd')]),
            username: $username,
        ));

        $user = $this->searchUserByUsername($username);
        static::assertInstanceOf(User::class, $user);

        $users->delete('master', $user->getId());

        $user = $this->searchUserByUsername($username);
        static::assertNull($user);
    }

    public function testGetUserCredentials(): void
    {
        $users = $this->getKeycloak()->users();
        $username = Uuid::uuid4()->toString();

        $users->create('master', new User(
            credentials: new CredentialCollection([$this->createPasswordCredential('p4ssw0rd')]),
            username: $username,
        ));

        $user = $this->searchUserByUsername($username);
        static::assertInstanceOf(User::class, $user);

        $credentials = $users->credentials('master', $user->getId());
        static::assertInstanceOf(CredentialCollection::class, $credentials);

        $users->delete('master', $user->getId());

        $user = $this->searchUserByUsername($username);
        static::assertNull($user);
    }

    public function testExecuteActionsEmail(): void
    {
        $users = $this->getKeycloak()->users();
        $username = Uuid::uuid4()->toString();

        $users->create('master', new User(
            email: 'john.doe@example.com',
            enabled: true,
            username: $username,
        ));

        $user = $this->searchUserByUsername($username);
        static::assertInstanceOf(User::class, $user);

        try {
            $users->executeActionsEmail('master', $user->getId(), ['UPDATE_PASSWORD']);
        } catch (ServerException $e) {
            static::assertSame(500, $e->getResponse()->getStatusCode());
            static::assertStringContainsString('Failed to send execute actions email', $e->getResponse()->getBody()->getContents());
        }

        $users->delete('master', $user->getId());

        $user = $this->searchUserByUsername($username);
        static::assertNull($user);
    }

    private function searchUserByUsername(string $username, string $realm = 'master'): ?User
    {
        /** @var User|null $user */
        $user = $this->getKeycloak()->users()->search($realm, new Criteria([
            'username' => $username,
            'exact' => true,
        ]))->first();

        return $user;
    }

    private function createPasswordCredential(string $password): Credential
    {
        $salt = random_bytes(16);
        $iterations = 27500;

        $hash = hash_pbkdf2('sha256', $password, $salt, 27500, 64, true);

        return new Credential(
            credentialData: json_encode([
                'hashIterations' => $iterations,
                'algorithm' => 'pbkdf2-sha256',
            ], JSON_THROW_ON_ERROR),
            secretData: json_encode([
                'value' => base64_encode($hash),
                'salt' => base64_encode($salt),
            ], JSON_THROW_ON_ERROR),
            type: 'password',
        );
    }
}
