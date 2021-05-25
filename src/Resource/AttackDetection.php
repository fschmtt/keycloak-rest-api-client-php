<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Representation\Realm;

class AttackDetection extends Resource
{
    private const BASE_PATH = '/auth/admin/realms/{realm}/attack-detection/brute-force/users';

    public function clear(Realm $realm): void
    {
        $this->httpClient->request(
            'DELETE',
            $this->replaceRealmInBasePath($realm->getRealm())
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
