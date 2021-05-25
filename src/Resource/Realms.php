<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Json\JsonDecoder;
use Fschmtt\Keycloak\Representation\Realm;

class Realms extends Resource
{
    private const BASE_PATH = '/auth/admin/realms';

    private ?Realm $realm;

    public function all(): array
    {
        /** @var Realm[] $realms */
        $realms = [];

        $response = (string) $this->httpClient->request(
            'GET',
            self::BASE_PATH
        )->getBody();

        $decoded = (new JsonDecoder())->decode($response);

        foreach ($decoded as $realm) {
            $realms[] = Realm::from($realm);
        }

        return $realms;
    }

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
