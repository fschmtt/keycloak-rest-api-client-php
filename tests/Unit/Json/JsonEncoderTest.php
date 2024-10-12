<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Json;

use Fschmtt\Keycloak\Exception\JsonEncodeException;
use Fschmtt\Keycloak\Json\JsonEncoder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(JsonEncoder::class)]
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
            ]),
        );
    }

    public function testThrowsExceptionOnMalformedJson(): void
    {
        $this->expectException(JsonEncodeException::class);

        $this->decoder->encode(NAN);
    }
}
