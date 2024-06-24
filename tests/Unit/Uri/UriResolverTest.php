<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Uri;

use Fschmtt\Keycloak\Exception\FilesystemException;
use Fschmtt\Keycloak\Uri\UriResolver;
use PHPUnit\Framework\TestCase;

class UriResolverTest extends TestCase
{
    public function testResolveJson(): void
    {
        // Arrange
        $fixture = 'tests/Fixtures/test-realm.json';
        $expected = json_decode(file_get_contents($fixture), true);

        // Act
        $json = (new UriResolver())->resolve($fixture);

        // Assert
        $this->assertSame($expected, $json);
    }

    public function testThrowsExceptionIfFileNotFound(): void
    {
        // Assert
        $this->expectException(FilesystemException::class);

        // Act
        (new UriResolver())->resolve('tests/Fixtures/non-existing-file.json');
    }

    public function testResolveContentOfDir(): void
    {
        // Arrange
        $fixture = 'tests/Fixtures/dir';
        $json = json_decode(file_get_contents('tests/Fixtures/import.json'), true);

        $expected = array_values(array_filter($json, fn ($realm) => $realm['realm'] === 'test'));

        // Act
        $json = (new UriResolver())->resolve($fixture);

        // Assert
        $this->assertSame($expected[0]['users'], $json[0]['users']);
        $this->assertSame($expected[0]['realm'], $json[0]['realm']);
    }

    public function testResolveZip(): void
    {
        // Arrange
        $fixture = 'tests/Fixtures/data.zip';
        $json = json_decode(file_get_contents('tests/Fixtures/import.json'), true);

        $expected = array_values(array_filter($json, fn ($realm) => $realm['realm'] === 'test'));

        // Act
        $json = (new UriResolver())->resolve($fixture);

        // Assert
        $this->assertSame($expected[0]['users'], $json[0]['users']);
        $this->assertSame($expected[0]['realm'], $json[0]['realm']);
    }
}
