<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Stub;

use Fschmtt\Keycloak\OAuth\GrantType\Password as BasePassword;

class Password extends BasePassword
{
    public function __construct(
        string $username = 'admin',
        string $password = 'admin',
        string $clientId = 'admin-cli',
        string $realm = 'master',
        ?string $clientSecret = null,
        ?string $scope = null,
    ) {
        parent::__construct($username, $password, $clientId, $realm, $clientSecret, $scope);
    }
}
