<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Json;

use JsonException;

class JsonEncoder
{
    /**
     * @throws JsonException
     */
    public function encode(array $data): string
    {
        return json_encode(value: $data, flags: JSON_THROW_ON_ERROR);
    }
}
