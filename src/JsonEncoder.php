<?php declare(strict_types=1);

namespace Fschmtt\Keycloak;

class JsonEncoder
{
    public function encode(array $data): string
    {
        return json_encode(value: $data, flags: JSON_THROW_ON_ERROR);
    }
}
