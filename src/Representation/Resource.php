<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Resource extends Representation
{
    protected ?string $id;

    /**
     * @var string[]|null
     */
    protected ?array $attributes;

    protected ?string $displayName;

    protected ?string $icon_uri;

    protected ?string $name;

    protected ?bool $ownerManagedAccess;

    /**
     * @var Scope[]|null
     */
    protected ?array $scopes;

    protected ?string $type;

    /**
     * @var string[]|null
     */
    protected ?array $uris;

    public static function from(array $properties): static
    {
        foreach ($properties as $property => $value) {
            if ($property === 'scopes') {
                $properties[$property] = Scope::from($value);
            }
        }

        return parent::from($properties);
    }
}
