<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class AuthenticationFlow extends Representation
{
    protected ?string $alias;

    /**
     * @var AuthenticationExecutionExport[]|null
     */
    protected ?array $authenticationExecutions;

    protected ?bool $builtIn;

    protected ?string $description;

    protected ?string $id;

    protected ?string $providerId;

    protected ?bool $topLevel;

    public static function from(array $properties): static
    {
        foreach ($properties as $property => $value) {
            if ($property === 'authenticationExecutions') {
                $authenticationExecutions = [];

                foreach ($value as $authenticationExecution) {
                    $authenticationExecutions[] = AuthenticationExecutionExport::from($authenticationExecution);
                }

                $properties[$property] = $authenticationExecutions;
            }
        }

        return parent::from($properties);
    }
}
