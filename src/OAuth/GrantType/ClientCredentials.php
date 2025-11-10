<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth\GrantType;

use Fschmtt\Keycloak\OAuth\GrantType;

class ClientCredentials extends GrantType
{
    public const GRANT_TYPE = 'client_credentials';

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $realm,
        ?string $scope = null,
    ) {
        parent::__construct(self::GRANT_TYPE, $clientId, $realm, $clientSecret, $scope);
    }

    public function toRequestParams(): array
    {
        $requestParams = [
            'grant_type' => $this->grantType,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope,
        ];

        return array_filter($requestParams);
    }
}
