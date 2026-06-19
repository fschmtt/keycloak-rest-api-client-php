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
        $allUsers = $resource->all(realm: 'master');
        static::assertGreaterThanOrEqual(1, $allUsers->count());
        $user = $allUsers->first();
        static::assertInstanceOf(User::class, $user);

        // Create user
        $resource->create(
            new User(firstName: $importedFirstName, username: $importedUsername),
            'master',
        );

        // Search (imported) user
        $importedUser = $this->searchUserByUsername($importedUsername);
        static::assertInstanceOf(User::class, $importedUser);
        static::assertEquals($importedFirstName, $importedUser->getFirstName());

        // Get single (imported) user
        $importedUser = $resource->get($importedUser->getId(), 'master');
        static::assertSame($importedUsername, $importedUser->getUsername());

        // Update (imported) user
        $resource->update($importedUser->getId(), $importedUser->withFirstName($updatedFirstName), 'master');

        $updatedUser = $this->searchUserByUsername($importedUsername);
        static::assertInstanceOf(User::class, $updatedUser);
        static::assertSame($updatedFirstName, $updatedUser->getFirstName());

        // Delete (imported) user
        $resource->delete($updatedUser->getId(), 'master');

        try {
            $resource->get($updatedUser->getId(), 'master');
            static::fail('User should not exist anymore');
        } catch (Exception $e) {
            static::assertSame(404, $e->getCode());
        }
    }

    public function testJoinRetrieveLeaveGroupUser(): void
    {
        $users = $this->getKeycloak()->users();
        $user = $users->all(realm: 'master')->first();
        static::assertInstanceOf(User::class, $user);

        // create a temp group required for our test
        $groups = $this->getKeycloak()->groups();
        $groupName = Uuid::uuid4()->toString();
        $groups->create(
            new Group(name: $groupName),
            'master',
        );
        $group = $groups->all(realm: 'master')->first();
        static::assertInstanceOf(Group::class, $group);

        // join group
        $users->joinGroup($user->getId(), $group->getId(), 'master');

        $userGroups = $users->retrieveGroups($user->getId(), realm: 'master');
        static::assertGreaterThanOrEqual(1, $userGroups->count());
        $userFirstGroup = $userGroups->first();
        static::assertInstanceOf(Group::class, $userFirstGroup);
        static::assertSame($group->getId(), $userFirstGroup->getId());

        // get group members
        $groupMembers = $groups->members($group->getId(), realm: 'master');
        static::assertSame(1, $groupMembers->count());
        static::assertInstanceOf(User::class, $groupMembers->first());
        static::assertSame($user->getId(), $groupMembers->first()->getId());

        // leave group
        $users->leaveGroup($user->getId(), $group->getId(), 'master');

        $userGroups = $users->retrieveGroups($user->getId(), realm: 'master');
        static::assertGreaterThanOrEqual(0, $userGroups->count());

        // remove the temp group
        $groups->delete($group->getId(), 'master');
    }

    public function testAddRemoveRealmRoleUser(): void
    {
        try {
            // create a role required for our test
            $this->getKeycloak()->roles()->create(new Role(
                name: 'test-user-role',
            ), 'master');

            $users = $this->getKeycloak()->users();
            $user = $users->all(realm: 'master')->first();
            static::assertInstanceOf(User::class, $user);

            // retrieve user's roles and count them
            $roles = $users->retrieveRealmRoles($user->getId(), 'master');
            $rolesCount = $roles->count();

            // retrieve user's available roles and count them
            $availableRoles = $users->retrieveAvailableRealmRoles($user->getId(), 'master');
            $availableRolesCount = $availableRoles->count();
            static::assertGreaterThanOrEqual(1, $availableRolesCount);
            $role = $availableRoles->first();
            static::assertInstanceOf(Role::class, $role);

            // add the first available role to the user
            $users->addRealmRoles($user->getId(), new RoleCollection([$role]), 'master');

            $roles = $users->retrieveRealmRoles($user->getId(), 'master');
            static::assertEquals($rolesCount + 1, $roles->count());
            static::assertContainsEquals($role, $roles);

            $availableRoles = $users->retrieveAvailableRealmRoles($user->getId(), 'master');
            static::assertEquals($availableRolesCount - 1, $availableRoles->count());

            // remove the role from the user (back to the initial state)
            $users->removeRealmRoles($user->getId(), new RoleCollection([$role]), 'master');

            $roles = $users->retrieveRealmRoles($user->getId(), 'master');
            static::assertEquals($rolesCount, $roles->count());
            static::assertNotContainsEquals($role, $roles);

            $availableRoles = $users->retrieveAvailableRealmRoles($user->getId(), 'master');
            static::assertEquals($availableRolesCount, $availableRoles->count());
        } finally {
            $this->getKeycloak()->roles()->delete('test-user-role', 'master');
        }
    }

    public function testAddRemoveClientRoleUser(): void
    {
        $users = $this->getKeycloak()->users();
        $user = $users->all(realm: 'master')->first();
        static::assertInstanceOf(User::class, $user);

        $clients = $this->getKeycloak()->clients()->all(realm: 'master');

        $clientWithAvailableRole = null;
        $availableRoles = null;

        foreach ($clients as $client) {
            $available = $users->retrieveAvailableClientRoles($user->getId(), $client->getId(), 'master');
            if ($available->count() > 0) {
                $clientWithAvailableRole = $client;
                $availableRoles = $available;
                break;
            }
        }

        static::assertNotNull($clientWithAvailableRole);
        static::assertNotNull($availableRoles);

        $roles = $users->retrieveClientRoles($user->getId(), $clientWithAvailableRole->getId(), 'master');
        $rolesCount = $roles->count();

        $availableRolesCount = $availableRoles->count();
        static::assertGreaterThanOrEqual(1, $availableRolesCount);
        $role = $availableRoles->first();
        static::assertInstanceOf(Role::class, $role);

        $users->addClientRoles($user->getId(), new RoleCollection([$role]), $clientWithAvailableRole->getId(), 'master');

        $roles = $users->retrieveClientRoles($user->getId(), $clientWithAvailableRole->getId(), 'master');
        static::assertEquals($rolesCount + 1, $roles->count());
        static::assertContainsEquals($role, $roles);

        $availableRoles = $users->retrieveAvailableClientRoles($user->getId(), $clientWithAvailableRole->getId(), 'master');
        static::assertEquals($availableRolesCount - 1, $availableRoles->count());

        $users->removeClientRoles($user->getId(), new RoleCollection([$role]), $clientWithAvailableRole->getId(), 'master');

        $roles = $users->retrieveClientRoles($user->getId(), $clientWithAvailableRole->getId(), 'master');
        static::assertEquals($rolesCount, $roles->count());
        static::assertNotContainsEquals($role, $roles);

        $availableRoles = $users->retrieveAvailableClientRoles($user->getId(), $clientWithAvailableRole->getId(), 'master');
        static::assertEquals($availableRolesCount, $availableRoles->count());
    }

    public function testCreateUserWithPasswordCredential(): void
    {
        $users = $this->getKeycloak()->users();
        $username = Uuid::uuid4()->toString();

        $users->create(new User(
            credentials: new CredentialCollection([$this->createPasswordCredential('p4ssw0rd')]),
            username: $username,
        ), 'master');

        $user = $this->searchUserByUsername($username);
        static::assertInstanceOf(User::class, $user);

        $users->delete($user->getId(), 'master');

        $user = $this->searchUserByUsername($username);
        static::assertNull($user);
    }

    public function testGetUserCredentials(): void
    {
        $users = $this->getKeycloak()->users();
        $username = Uuid::uuid4()->toString();

        $users->create(new User(
            credentials: new CredentialCollection([$this->createPasswordCredential('p4ssw0rd')]),
            username: $username,
        ), 'master');

        $user = $this->searchUserByUsername($username);
        static::assertInstanceOf(User::class, $user);

        $credentials = $users->credentials($user->getId(), 'master');
        static::assertInstanceOf(CredentialCollection::class, $credentials);

        $users->delete($user->getId(), 'master');

        $user = $this->searchUserByUsername($username);
        static::assertNull($user);
    }

    public function testExecuteActionsEmail(): void
    {
        $users = $this->getKeycloak()->users();
        $username = Uuid::uuid4()->toString();

        $users->create(new User(
            email: 'john.doe@example.com',
            enabled: true,
            username: $username,
        ), 'master');

        $user = $this->searchUserByUsername($username);
        static::assertInstanceOf(User::class, $user);

        try {
            $users->executeActionsEmail($user->getId(), ['UPDATE_PASSWORD'], realm: 'master');
        } catch (ServerException $e) {
            static::assertSame(500, $e->getResponse()->getStatusCode());
            static::assertStringContainsString('Failed to send execute actions email', $e->getResponse()->getBody()->getContents());
        }

        $users->delete($user->getId(), 'master');

        $user = $this->searchUserByUsername($username);
        static::assertNull($user);
    }

    private function searchUserByUsername(string $username, string $realm = 'master'): ?User
    {
        /** @var User|null $user */
        $user = $this->getKeycloak()->users()->search(new Criteria([
            'username' => $username,
            'exact' => true,
        ]), $realm)->first();

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
