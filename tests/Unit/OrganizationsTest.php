<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit;

use DateTimeImmutable;
use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\Enum\MembershipType;
use Fschmtt\Keycloak\Enum\OrganizationInvitationStatus;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\OAuth\GrantType;
use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory;
use Fschmtt\Keycloak\Representation\Organization;
use Fschmtt\Keycloak\Resource\Organizations;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Organizations::class)]
class OrganizationsTest extends TestCase
{
    use TokenGenerator;

    private MockHandler $handler;

    private Organizations $organizations;

    protected function setUp(): void
    {
        $this->handler = new MockHandler();
        $storage = new InMemory();
        $storage->storeAccessToken($this->generateToken(new DateTimeImmutable('+5 minutes')));

        $keycloak = (new Builder())
            ->withBaseUrl('https://keycloak.example.test')
            ->withGrantType(GrantType::clientCredentials('admin', 'secret'))
            ->withTokenStorage($storage)
            ->withHttpClient(new Client(['handler' => $this->handler]))
            ->withVersion('26.7.1')
            ->build();

        $this->organizations = $keycloak->organizations();
    }

    public function testCreatesAnOrganizationAndReturnsItsLocationId(): void
    {
        $this->handler->append(new Response(201, [
            'Location' => 'https://keycloak.example.test/admin/realms/diwan/organizations/org-123',
        ]));

        $id = $this->organizations->createAndGetId(
            'diwan',
            new Organization(name: 'Acme', alias: 'acme', enabled: true),
        );

        static::assertSame('org-123', $id);
        $request = $this->handler->getLastRequest();

        static::assertNotNull($request);
        static::assertSame('POST', $request->getMethod());
        static::assertSame('/admin/realms/diwan/organizations', $request->getUri()->getPath());
    }

    public function testListsMembersWithFilters(): void
    {
        $this->handler->append(new Response(200, body: json_encode([[
            'id' => 'user-123',
            'email' => 'member@example.test',
            'emailVerified' => true,
            'membershipType' => 'MANAGED',
        ]], JSON_THROW_ON_ERROR)));

        $members = $this->organizations->members('diwan', 'org-123', new Criteria([
            'briefRepresentation' => false,
            'membershipType' => MembershipType::MANAGED,
            'first' => 10,
            'max' => 25,
        ]));
        $request = $this->handler->getLastRequest();

        static::assertNotNull($request);
        static::assertCount(1, $members);
        static::assertSame('member@example.test', $members->first()->getEmail());
        static::assertSame(MembershipType::MANAGED, $members->first()->getMembershipType());
        static::assertSame('briefRepresentation=false&membershipType=MANAGED&first=10&max=25', $request->getUri()->getQuery());
    }

    public function testListsAndManagesInvitations(): void
    {
        $this->handler->append(
            new Response(200, body: json_encode([[
                'id' => 'invite-123',
                'organizationId' => 'org-123',
                'email' => 'invitee@example.test',
                'sentDate' => 1_755_000_000,
                'expiresAt' => 1_755_604_800,
                'status' => 'PENDING',
            ]], JSON_THROW_ON_ERROR)),
            new Response(204),
            new Response(204),
        );

        $invitations = $this->organizations->invitations('diwan', 'org-123', new Criteria([
            'status' => OrganizationInvitationStatus::PENDING,
            'email' => 'invitee@example.test',
        ]));
        $listRequest = $this->handler->getLastRequest();
        $this->organizations->resendInvitation('diwan', 'org-123', 'invite-123');
        $resendRequest = $this->handler->getLastRequest();
        $this->organizations->deleteInvitation('diwan', 'org-123', 'invite-123');
        $deleteRequest = $this->handler->getLastRequest();

        static::assertNotNull($listRequest);
        static::assertNotNull($resendRequest);
        static::assertNotNull($deleteRequest);
        static::assertSame(OrganizationInvitationStatus::PENDING, $invitations->first()?->getStatus());
        static::assertSame('status=PENDING&email=invitee%40example.test', $listRequest->getUri()->getQuery());
        static::assertSame('/admin/realms/diwan/organizations/org-123/invitations/invite-123/resend', $resendRequest->getUri()->getPath());
        static::assertSame('DELETE', $deleteRequest->getMethod());
    }
}
