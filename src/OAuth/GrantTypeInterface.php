<?php

namespace Fschmtt\Keycloak\OAuth;

interface GrantTypeInterface
{
    /**
     * Returns form parameters for fetching an access token.
     *
     * @return array<string, string>
     */
    public function getFetchTokenFormParams(): array;

    /**
     * Returns form parameters for refreshing an access token.
     *
     * @param string|null $refreshToken
     * @return array<string, string>
     */
    public function getRefreshTokenFormParams(?string $refreshToken): array;
}
