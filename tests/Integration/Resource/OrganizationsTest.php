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

    private const REALM = 'organizations-test';

    protected function setUp(): void
    {
        $this->skipIfKeycloakVersionIsLessThan('26.0.0');
    }

    public function testOrganizations(): void
    {
        // Create realm
        $this->getKeycloak()->realms()->import(new Realm(realm: self::REALM, organizationsEnabled: true));

        // No organizations exist yet in realm
        $organizations = $this->getKeycloak()->organizations()->all(realm: self::REALM);
        static::assertCount(0, $organizations);

        // Create a new organization in realm
        $createdOrganization = new Organization(
            name: 'created-organization',
            domains: new OrganizationDomainCollection([
                new OrganizationDomain('foo.bar', true),
                new OrganizationDomain('bar.foo', false),
            ]),
        );
        $this->getKeycloak()->organizations()->create($createdOrganization, realm: self::REALM);

        $organizations = $this->getKeycloak()->organizations()->all(realm: self::REALM);
        static::assertCount(1, $organizations);
        static::assertSame($createdOrganization->getName(), $organizations->first()->getName());

        // Get newly created organization
        $organization = $this->getKeycloak()->organizations()->get($organizations->first()->getId(), realm: self::REALM);
        static::assertSame($createdOrganization->getName(), $organization->getName());

        try {
            // Invite user to newly created organization
            $this->getKeycloak()->organizations()->inviteUser(
                $organizations->first()->getId(),
                'john@doe.com',
                'John',
                'Doe',
                realm: self::REALM,
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
        $this->getKeycloak()->organizations()->addUser($organization->getId(), $this->createAndGetUser()->getId(), realm: self::REALM);

        // Update organization
        $updatedOrganization = $organization->withDomains(new OrganizationDomainCollection([
            new OrganizationDomain('foo.bar.updated', true),
            new OrganizationDomain('bar.foo.updated', false),
        ]));
        $this->getKeycloak()->organizations()->update($organization->getId(), $updatedOrganization, realm: self::REALM);
        $organizations = $this->getKeycloak()->organizations()->all(realm: self::REALM);
        static::assertCount(1, $organizations);
        static::assertSame($updatedOrganization->getName(), $organizations->first()->getName());
        $domains = $organizations->first()->getDomains();
        static::assertCount(2, $domains);
        static::assertSame([
            'foo.bar.updated',
            'bar.foo.updated',
        ], array_map(static fn (OrganizationDomain $domain) => $domain->getName(), $domains->all()));

        // Delete newly created organization
        $this->getKeycloak()->organizations()->delete($organizations->first()->getId(), realm: self::REALM);
        $organizations = $this->getKeycloak()->organizations()->all(realm: self::REALM);
        static::assertCount(0, $organizations);

        // Delete realm
        $this->getKeycloak()->realms()->delete(self::REALM);
    }

    private function createAndGetUser(): User
    {
        $users = $this->getKeycloak()->users();

        $users->create(new User(
            username: $username = Uuid::uuid4()->toString(),
        ), realm: self::REALM);

        return $users->search(new Criteria([
            'username' => $username,
            'exact' => true,
        ]), realm: self::REALM)->first();
    }
}
