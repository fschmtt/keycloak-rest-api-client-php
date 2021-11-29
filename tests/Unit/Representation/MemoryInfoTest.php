<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Exception\ReadOnlyException;
use PHPUnit\Framework\TestCase;

class MemoryInfoTest extends TestCase
{
    public function testThrowsReadOnlyException(): void
    {
        $memoryInfo = new MemoryInfo();

        $this->expectException(ReadOnlyException::class);

        $memoryInfo->with('totalFormated', '2G');
    }
}
