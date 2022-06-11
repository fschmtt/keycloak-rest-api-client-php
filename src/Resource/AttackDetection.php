<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Json\JsonDecoder;
use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\User;
use Fschmtt\Keycloak\Type\Map;

class AttackDetection extends Resource
{
    private const BASE_PATH = '/admin/realms/{realm}/attack-detection/brute-force/users';

    public function clear(Realm $realm): void
    {
        $this->httpClient->request(
            'DELETE',
            $this->replaceRealmInBasePath($realm->getRealm())
        );
    }

    public function user(Realm $realm, User $user): Map
    {
        return new Map(
            (new JsonDecoder())->decode(
                (string) $this->httpClient->request(
                    'GET',
                    sprintf('%s/%s', $this->replaceRealmInBasePath($realm->getRealm()), $user->getId())
                )->getBody()
            )
        );
    }

    public function clearUser(Realm $realm, User $user): void
    {
        $this->httpClient->request(
            'DELETE',
            sprintf('%s/%s', $this->replaceRealmInBasePath($realm->getRealm()), $user->getId())
        );
    }

    private function replaceRealmInBasePath(string $realm): string
    {
        return str_replace(
            search: '{realm}',
            replace: $realm,
            subject: self::BASE_PATH
        );
    }
}
