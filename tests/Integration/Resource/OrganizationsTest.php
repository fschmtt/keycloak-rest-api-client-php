<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Fschmtt\Keycloak\Collection\OrganizationDomainCollection;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Representation\Organization;
use Fschmtt\Keycloak\Representation\OrganizationDomain;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\User;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use GuzzleHttp\Exception\ServerException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class OrganizationsTest extends TestCase
{
    use IntegrationTestBehaviour;

    private const REALM = 'organizations-tests';

    protected function setUp(): void
    {
        $this->skipIfKeycloakVersionIsLessThan('26.0.0');
    }

    public function testOrganizations(): void
    {
        // Create realm
        $this->getKeycloak()->realms()->import(new Realm(realm: self::REALM, organizationsEnabled: true));

        // No organizations exist yet in realm
        $organizations = $this->getKeycloak()->organizations()->all(self::REALM);
        static::assertCount(0, $organizations);

        // Create a new organization in realm
        $createdOrganization = new Organization(
            name: 'created-organization',
            domains: new OrganizationDomainCollection([
                new OrganizationDomain('foo.bar', true),
                new OrganizationDomain('bar.foo', false),
            ]),
        );
        $this->getKeycloak()->organizations()->create(self::REALM, $createdOrganization);

        $organizations = $this->getKeycloak()->organizations()->all(self::REALM);
        static::assertCount(1, $organizations);
        static::assertSame($createdOrganization->getName(), $organizations->first()->getName());

        // Get newly created organization
        $organization = $this->getKeycloak()->organizations()->get(self::REALM, $organizations->first()->getId());
        static::assertSame($createdOrganization->getName(), $organization->getName());

        try {
            // Invite user to newly created organization
            $this->getKeycloak()->organizations()->inviteUser(
                self::REALM,
                $organizations->first()->getId(),
                'john@doe.com',
                'John',
                'Doe',
            );
        } catch (ServerException $e) {
            // Error is expected as SMTP is not configured
            static::assertSame(500, $e->getCode());
            static::assertSame(
                ['errorMessage' => 'Failed to send invite email'],
                json_decode($e->getResponse()->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
            );
        }

        // Create user and add it to the organization
        $this->getKeycloak()->organizations()->addUser(self::REALM, $organization->getId(), $this->createAndGetUser()->getId());

        // Delete newly created organization
        $this->getKeycloak()->organizations()->delete(self::REALM, $organizations->first()->getId());
        $organizations = $this->getKeycloak()->organizations()->all(self::REALM);
        static::assertCount(0, $organizations);

        // Delete realm
        $this->getKeycloak()->realms()->delete(self::REALM);
    }

    private function createAndGetUser(): User
    {
        $users = $this->getKeycloak()->users();

        $users->create(self::REALM, new User(
            username: $username = Uuid::uuid4()->toString(),
        ));

        return $users->search(self::REALM, new Criteria([
            'username' => $username,
            'exact' => true,
        ]))->first();
    }
}
