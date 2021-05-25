<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Json;

use Fschmtt\Keycloak\Exception\JsonDecodeException;
use JsonException;

use function json_decode;

class JsonDecoder
{
    /**
     * @throws JsonDecodeException
     */
    public function decode(string $json): array
    {
        try {
            return json_decode(json: $json, associative: true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new JsonDecodeException(previous: $e);
        }
    }
}
