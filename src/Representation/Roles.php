<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Roles
{
    /**
     * @var array|null
     */
    private $client;

    /**
     * @var Role[]|null
     */
    private $realm;

    /**
     * @param array|null $client
     * @param Role[]|null $realm
     */
    public function __construct(
        ?array $client,
        ?array $realm
    ) {
        $this->client = $client;
        $this->realm = $realm;
    }

    /**
     * @return array|null
     */
    public function getClient(): ?array
    {
        return $this->client;
    }

    /**
     * @return Role[]|null
     */
    public function getRealm(): ?array
    {
        return $this->realm;
    }
}
