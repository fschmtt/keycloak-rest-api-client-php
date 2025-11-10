<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit;

use Fschmtt\Keycloak\Builder;
use Fschmtt\Keycloak\Exception\BuilderException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Builder::class)]
class BuilderTest extends TestCase
{
    public function testThrowsExceptionIfBaseUrlIsNotSet(): void
    {
        $builder = new Builder();

        $this->expectException(BuilderException::class);
        $this->expectExceptionMessage('Base URL is not set');

        $builder->build();
    }

    public function testThrowsExceptionIfGrantTypeIsNotSet(): void
    {
        $builder = (new Builder())
            ->withBaseUrl('http://keycloak:8080');

        $this->expectException(BuilderException::class);
        $this->expectExceptionMessage('Grant type is not set');

        $builder->build();
    }
}
