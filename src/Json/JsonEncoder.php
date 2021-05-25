<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Json;

use Fschmtt\Keycloak\Exception\JsonEncodeException;
use JsonException;

use function json_encode;

class JsonEncoder
{
    /**
     * @throws JsonEncodeException
     */
    public function encode(mixed $data): string
    {
        try {
            return json_encode(value: $data, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new JsonEncodeException(previous: $e);
        }
    }
}
