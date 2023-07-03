<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Stub;

/**
 * @extends \Fschmtt\Keycloak\Collection\Collection<Representation>
 */
class Collection extends \Fschmtt\Keycloak\Collection\Collection
{
    public static function getRepresentationClass(): string
    {
        return Representation::class;
    }
}
