<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Json;

use Fschmtt\Keycloak\Exception\JsonEncodeException;
use Fschmtt\Keycloak\Json\JsonEncoder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Json\JsonEncoder
 */
class JsonEncoderTest extends TestCase
{
    private JsonEncoder $decoder;

    protected function setUp(): void
    {
        $this->decoder = new JsonEncoder();
    }

    public function testCanEncode(): void
    {
        self::assertSame(
            '{"Hey":"I am a valid JSON string!"}',
            $this->decoder->encode([
                'Hey' => 'I am a valid JSON string!',
            ])
        );
    }

    public function testThrowsExceptionOnMalformedJson(): void
    {
        $this->expectException(JsonEncodeException::class);

        $this->decoder->encode(NAN);
    }
}
