<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Http\Command;
use Fschmtt\Keycloak\Http\Criteria;
use Fschmtt\Keycloak\Http\Method;
use Fschmtt\Keycloak\Test\Unit\Stub\Collection;
use Fschmtt\Keycloak\Test\Unit\Stub\Representation;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Command::class)]
class CommandTest extends TestCase
{
    public function testHasNoPayloadByDefault(): void
    {
        static::assertNull((new Command('/path', Method::POST))->getPayload());
    }

    public function testCanGetRepresentationPayload(): void
    {
        $representation = new Representation();

        static::assertSame(
            $representation,
            (new Command('/path', Method::POST, [], $representation))->getPayload()
        );
    }

    public function testCanGetCollectionPayload(): void
    {
        $payload = new Collection([new Representation()]);

        static::assertSame(
            $payload,
            (new Command('/path', Method::POST, [], $payload))->getPayload()
        );
    }

    public function testSubstitutesParametersInPath(): void
    {
        static::assertSame(
            '/admin/realms/master/groups/group-uuid',
            (new Command(
                '/admin/realms/{realm}/groups/{groupId}',
                Method::GET,
                [
                    'realm' => 'master',
                    'groupId' => 'group-uuid',
                ]
            ))->getPath()
        );
    }

    public function testSupportsAnyMethod(): void
    {
        foreach (Method::cases() as $method) {
            static::assertSame(
                $method->value,
                (new Command('/path', $method))->getMethod()->value
            );
        }
    }

    public function testBuildsPathWithQueryIfCriteriaIsProvided(): void
    {
        static::assertSame(
            '/admin/realms/master/users/user-uuid/execute-actions-email?client_id=foo&lifespan=600',
            (new Command(
                '/admin/realms/{realm}/users/{userId}/execute-actions-email',
                Method::PUT,
                [
                    'realm' => 'master',
                    'userId' => 'user-uuid',
                ],
                ['UPDATE_PASSWORD'],
                new Criteria([
                    'client_id' => 'foo',
                    'lifespan' => 600,
                ]),
            ))->getPath()
        );
    }
}
