<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Json;

use JsonException;

class JsonDecoder
{
    /**
     * @throws JsonException
     */
    public function decode(string $json): array
    {
        return json_decode(json: $json, associative: true, flags: JSON_THROW_ON_ERROR);
    }
}
