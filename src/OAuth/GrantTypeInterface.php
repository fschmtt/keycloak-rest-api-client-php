<?php

namespace Fschmtt\Keycloak\OAuth;

use GuzzleHttp\ClientInterface;

interface GrantTypeInterface
{
    /**
     * @return array{access_token: non-empty-string, refresh_token: non-empty-string|null}
     */
    public function fetchTokens(ClientInterface $httpClient, string $baseUrl, ?string $refreshToken = null): array;
}
