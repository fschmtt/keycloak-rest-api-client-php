<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use PHPUnit\Framework\Attributes\IgnoreClassForCodeCoverage;

#[IgnoreClassForCodeCoverage(self::class)]
class ScopeMapping extends Representation
{
    /**
     * @var string|null
     */
    private $client;

    /**
     * @var string|null
     */
    private $clientScope;

    /**
     * @var string[]|null
     */
    private $roles;

    /**
     * @var string|null
     */
    private $self;

    /**
     * @param string|null $client
     * @param string|null $clientScope
     * @param string[]|null $roles
     * @param string|null $self
     */
    public function __construct(
        ?string $client,
        ?string $clientScope,
        ?array $roles,
        ?string $self
    ) {
        $this->client = $client;
        $this->clientScope = $clientScope;
        $this->roles = $roles;
        $this->self = $self;
    }

    /**
     * @return string|null
     */
    public function getClient(): ?string
    {
        return $this->client;
    }

    /**
     * @return string|null
     */
    public function getClientScope(): ?string
    {
        return $this->clientScope;
    }

    /**
     * @return string[]|null
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @return string|null
     */
    public function getSelf(): ?string
    {
        return $this->self;
    }
}
