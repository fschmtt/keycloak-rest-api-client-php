<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

class Client extends Representation
{
    public function __construct(
        ?Map $access = null,
        ?string $adminUrl = null,
        ?bool $alwaysDisplayInConsole = null,
        ?Map $attributes = null,
        ?Map $authenticationFlowBindingOverrides = null,
        ?bool $authorizationServicesEnabled = null,
        ?ResourceServer $authorizationSettings = null,
        ?string $baseUrl = null,
        ?bool $bearerOnly = null,
        ?string $clientAuthenticatorType = null,
        ?string $clientId = null,
        ?bool $consentRequired = null,
        ?array $defaultClientScopes = null,
        ?string $description = null,
        ?bool $directAccessGrantsEnabled = null,
        ?bool $enabled = null,
        ?bool $frontchannelLogout = null,
        ?bool $fullScopeAllowed = null,
        ?string $ud = null,
        ?bool $implicitFlowEnabled = null,
        ?string $name = null,
        ?int $nodeReRegistrationTimeout = null,
        ?int $notBefore = null,
        ?bool $oauth2DeviceAuthorizationGrantEnabled = null,
        ?array $optionalClientScopes = null,
        ?string $origin = null,
        ?string $protocol = null,
        ?array $protocolMappers = null,
        ?bool $publicClient = null,
        ?array $redirectUris = null,
        ?Map $registeredNodes = null,
        ?string $registrationAccessToken = null,
        ?string $rootUrl = null,
        ?string $secret = null,
        ?bool $serviceAccountsEnabled = null,
        ?bool $standardFlowEnabled = null,
        ?bool $surrogateAuthRequired = null,
        ?array $webOrigins = null,
    ) {
        parent::__construct(
            $access,
            $adminUrl,
            $alwaysDisplayInConsole,
            $attributes,
            $authenticationFlowBindingOverrides,
            $authorizationServicesEnabled,
            $authorizationSettings,
            $baseUrl,
            $bearerOnly,
            $clientAuthenticatorType,
            $clientId,
            $consentRequired,
            $defaultClientScopes,
            $description,
            $directAccessGrantsEnabled,
            $enabled,
            $frontchannelLogout,
            $fullScopeAllowed,
            $ud,
            $implicitFlowEnabled,
            $name,
            $nodeReRegistrationTimeout,
            $notBefore,
            $oauth2DeviceAuthorizationGrantEnabled,
            $optionalClientScopes,
            $origin,
            $protocol,
            $protocolMappers,
            $publicClient,
            $redirectUris,
            $registeredNodes,
            $registrationAccessToken,
            $rootUrl,
            $secret,
            $serviceAccountsEnabled,
            $standardFlowEnabled,
            $surrogateAuthRequired,
            $webOrigins,
        );
    }
}