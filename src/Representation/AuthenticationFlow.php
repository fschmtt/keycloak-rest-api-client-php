<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class AuthenticationFlow
{
    /**
     * @var string
     */
    private $alias;

    /**
     * @var AuthenticationExecutionExport[]
     */
    private $authenticationExecutions;

    /**
     * @var bool
     */
    private $builtIn;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $providerId;

    /**
     * @var bool
     */
    private $topLevel;

    public function __construct(
        ?string $alias,
        ?array $authenticationExecutions,
        ?bool $builtIn,
        ?string $description,
        ?string $id,
        ?string $providerId,
        ?bool $topLevel
    ) {
        $this->alias = $alias;
        $this->authenticationExecutions = $authenticationExecutions;
        $this->builtIn = $builtIn;
        $this->description = $description;
        $this->id = $id;
        $this->providerId = $providerId;
        $this->topLevel = $topLevel;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return AuthenticationExecutionExport[]
     */
    public function getAuthenticationExecutions(): array
    {
        return $this->authenticationExecutions;
    }

    public function isBuiltIn(): bool
    {
        return $this->builtIn;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProviderId(): string
    {
        return $this->providerId;
    }

    public function isTopLevel(): bool
    {
        return $this->topLevel;
    }
}
