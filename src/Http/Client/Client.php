<?php

namespace Fschmtt\Keycloak\Http\Client;

use Psr\Http\Message\ResponseInterface;

interface Client
{
    /**
     * @param array<string, mixed> $options
     */
    public function request(string $method, string $path = '', array $options = []): ResponseInterface;

    public function isAuthorized(): bool;

}
