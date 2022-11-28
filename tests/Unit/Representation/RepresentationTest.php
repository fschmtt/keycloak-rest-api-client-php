<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Representation;

use Fschmtt\Keycloak\Exception\PropertyDoesNotExistException;
use Fschmtt\Keycloak\Exception\PropertyIsReadOnlyException;
use Fschmtt\Keycloak\Test\Unit\Stub\Representation;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Representation\Representation
 */
class RepresentationTest extends TestCase
{
    public function testThrowsExceptionIfPropertyDoesNotExist(): void
    {
        $representation = new Representation();

        $this->expectException(PropertyDoesNotExistException::class);
        $representation->with('nonExistingProperty', 'value');
    }

    public function testThrowsExceptionIfPropertyIsReadOnly(): void
    {
        $representation = new Representation();

        $this->expectException(PropertyIsReadOnlyException::class);
        $representation->with('readonly', 'value');
    }
}
