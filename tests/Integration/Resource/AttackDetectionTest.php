<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Integration\Resource;

use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\User;
use Fschmtt\Keycloak\Test\Integration\IntegrationTestBehaviour;
use PHPUnit\Framework\TestCase;

class AttackDetectionTest extends TestCase
{
    use IntegrationTestBehaviour;

    private Realm $realm;

    private User $user;

    public function setUp(): void
    {
        $this->realm = new Realm(realm: 'master');
        $this->user = new User(id: '978df19a-7fa5-441d-a4b6-e5ae238e5c12');
    }

    public function testCanClearAttackDetection(): void
    {
        static::expectNotToPerformAssertions();

        $this->getKeycloak()->attackDetection()->clear($this->realm);
    }

    public function testCanClearAttackDetectionForUser(): void
    {
        static::expectNotToPerformAssertions();

        $this->getKeycloak()->attackDetection()->clearUser($this->realm, $this->user);
    }

    public function testCanGetAttackDetectionForUser(): void
    {
        static::expectNotToPerformAssertions();

        $this->getKeycloak()->attackDetection()->user($this->realm, $this->user);
    }
}
