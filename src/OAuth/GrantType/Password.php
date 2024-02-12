<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType;

class Password extends GrantType
{
    public const GRANT_TYPE = 'password';

    public function __construct(
        public readonly string $username,
        public readonly string $password,
        string $clientId,
        string $realm,
        ?string $clientSecret = null,
        ?string $scope = null,
    ) {
        parent::__construct(self::GRANT_TYPE, $clientId, $realm, $clientSecret, $scope);
    }

    public function toRequestParams(): array
    {
        $requestParams = [
            'grant_type' => $this->grantType,
            'username' => $this->username,
            'password' => $this->password,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope,
        ];

        return array_filter($requestParams);
    }
}
