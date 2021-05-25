<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Representation\Realm;

class Realms extends Resource
{
    private const BASE_PATH = '/auth/admin/realms';

    public function get(string $realm): Realm
    {
        return Realm::fromJson(
            (string) $this->httpClient->request(
                'GET',
                self::BASE_PATH . '/' . $realm
            )->getBody()
        );
    }

    public function import(Realm $realm): Realm
    {
        $this->httpClient->request(
            'POST',
            self::BASE_PATH,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'realm' => $realm->getRealm(),
                    'displayName' => $realm->getDisplayName(),
                    'id' => $realm->getId(),
                ],
            ]
        );

        return $this->get($realm->getRealm());
    }
}
