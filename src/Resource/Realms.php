<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use Fschmtt\Keycloak\Json\JsonDecoder;
use Fschmtt\Keycloak\Json\JsonEncoder;
use Fschmtt\Keycloak\Representation\Realm;

class Realms extends Resource
{
    private const BASE_PATH = '/auth/admin/realms';

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
        $body = (new JsonEncoder())->encode($realm->jsonSerialize());

        $this->httpClient->request(
            'POST',
            self::BASE_PATH,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $body
            ]
        );

        return $this->get($realm->getRealm());
    }

    public function update(Realm $realm): Realm
    {
        $body = (new JsonEncoder())->encode($realm->jsonSerialize());

        $this->httpClient->request(
            'PUT',
            self::BASE_PATH . '/' . $realm->getRealm(),
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $body
            ]
        );

        return $this->get($realm->getRealm());
    }

    public function delete(Realm $realm): void
    {
        $this->httpClient->request(
            'DELETE',
            self::BASE_PATH . '/' . $realm->getRealm(),
        );
    }

    /**
     * @description Get admin events
     * @description Returns all admin events, or filters events based on URL query parameters listed here
     * TODO Query params
     */
    public function adminEvents(Realm $realm): array
    {
        return (new JsonDecoder())->decode(
            (string) $this->httpClient->request(
                'GET',
                self::BASE_PATH . '/' . $realm->getRealm() . '/admin-events'
            )->getBody()
        );
    }

    /**
     * @description Delete all admin events
     */
    public function deleteAdminEvents(Realm $realm): void
    {
        $this->httpClient->request(
        'DELETE',
            self::BASE_PATH . '/' . $realm->getRealm() . '/admin-events'
        );
    }

    /**
     * @description Clear cache of external public keys (Public keys of clients or Identity providers)
     */
    public function clearKeysCache(Realm $realm): void
    {
        $this->httpClient->request(
            'POST',
            self::BASE_PATH . '/' . $realm->getRealm() . '/clear-keys-cache'
        );
    }

    public function clearRealmCache(Realm $realm): void
    {
        $this->httpClient->request(
            'POST',
            self::BASE_PATH . '/' . $realm->getRealm() . '/clear-realm-cache'
        );
    }

    public function clearUserCache(Realm $realm): void
    {
        $this->httpClient->request(
            'POST',
            self::BASE_PATH . '/' . $realm->getRealm() . '/clear-user-cache'
        );
    }

    public function clientDescriptionConverter(Realm $realm, array $body): Client
    {
        return Client::from(
            (string) $this->httpClient->request(
                'POST',
                self::BASE_PATH . '/' . $realm->getRealm() . '/client-description-converter',
                [
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'body' =>  $body
                ]
            )->getBody()
        );
    }
}
