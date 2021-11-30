<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ProtocolMapperCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAccess()
 * @method string|null getAdminUrl()
 * @method bool|null getAlwaysDisplayInConsole()
 * @method Map|null getAttributes()
 * @method Map|null getAuthenticationFlowBindingOverrides()
 * @method bool|null getAuthorizationServicesEnabled()
 * @method ResourceServer|null getAuthorizationSettings()
 * @method string|null getBaseUrl()
 * @method bool|null getBearerOnly()
 * @method string|null getClientAuthenticatorType()
 * @method string|null getClientId()
 * @method bool|null getConsentRequired()
 * @method array|null getDefaultClientScopes()
 * @method string|null getDescription()
 * @method bool|null getDirectAccessGrantsEnabled()
 * @method bool|null getEnabled()
 * @method bool|null getFrontchannelLogout()
 * @method bool|null getFullScopeAllowed()
 * @method string|null getId()
 * @method bool|null getImplicitFlowEnabled()
 * @method string|null getName()
 * @method int|null getNodeReRegistrationTimeout()
 * @method int|null getNotBefore()
 * @method bool|null getOauth2DeviceAuthorizationGrantEnabled()
 * @method array|null getOptionalClientScopes()
 * @method string|null getOrigin()
 * @method string|null getProtocol()
 * @method ProtocolMapperCollection|null getProtocolMappers()
 * @method bool|null getPublicClient()
 * @method array|null getRedirectUris()
 * @method Map|null getRegisteredNodes()
 * @method string|null getRegistrationAccessToken()
 * @method string|null getRootUrl()
 * @method string|null getSecret()
 * @method bool|null getServiceAccountsEnabled()
 * @method bool|null getStandardFlowEnabled()
 * @method bool|null getSurrogateAuthRequired()
 * @method array|null getWebOrigins()
 * @method self withAccess(?Map $access)
 * @method self withAdminUrl(?string $adminUrl)
 * @method self withAlwaysDisplayInConsole(?bool $alwaysDisplayInConsole)
 * @method self withAttributes(?Map $attributes)
 * @method self withAuthenticationFlowBindingOverrides(?Map $authenticationFlowBindingOverrides)
 * @method self withAuthorizationServicesEnabled(?bool $authorizationServicesEnabled)
 * @method self withAuthorizationSettings(?ResourceServer $authorizationSettings)
 * @method self withBaseUrl(?string $baseUrl)
 * @method self withBearerOnly(?bool $bearerOnly)
 * @method self withClientAuthenticatorType(?string $clientAuthenticatorType)
 * @method self withClientId(?string $clientId)
 * @method self withConsentRequired(?bool $consentRequired)
 * @method self withDefaultClientScopes(?array $defaultClientScopes)
 * @method self withDescription(?string $description)
 * @method self withDirectAccessGrantsEnabled(?bool $directAccessGrantsEnabled)
 * @method self withEnabled(?bool $enabled)
 * @method self withFrontchannelLogout(?bool $frontchannelLogout)
 * @method self withFullScopeAllowed(?bool $fullScopeAllowed)
 * @method self withId(?string $id)
 * @method self withImplicitFlowEnabled(?bool $implicitFlowEnabled)
 * @method self withName(?string $name)
 * @method self withNodeReRegistrationTimeout(?int $nodeReRegistrationTimeout)
 * @method self withNotBefore(?int $notBefore)
 * @method self withOauth2DeviceAuthorizationGrantEnabled(?bool $oauth2DeviceAuthorizationGrantEnabled)
 * @method self withOptionalClientScopes(?array $optionalClientScopes)
 * @method self withOrigin(?string $origin)
 * @method self withProtocol(?string $protocol)
 * @method self withProtocolMappers(?ProtocolMapperCollection $protocolMappers)
 * @method self withPublicClient(?bool $publicClient)
 * @method self withRedirectUris(?array $redirectUris)
 * @method self withRegisteredNodes(?Map $registeredNodes)
 * @method self withRegistrationAccessToken(?string $registrationAccessToken)
 * @method self withRootUrl(?string $rootUrl)
 * @method self withSecret(?string $secret)
 * @method self withServiceAccountsEnabled(?bool $serviceAccountsEnabled)
 * @method self withStandardFlowEnabled(?bool $standardFlowEnabled)
 * @method self withSurrogateAuthRequired(?bool $surrogateAuthRequired)
 * @method self withWebOrigins(?array $webOrigins)
 */
class Client extends Representation
{
    public function __construct(
        protected ?Map $access = null,
        protected ?string $adminUrl = null,
        protected ?bool $alwaysDisplayInConsole = null,
        protected ?Map $attributes = null,
        protected ?Map $authenticationFlowBindingOverrides = null,
        protected ?bool $authorizationServicesEnabled = null,
        protected ?ResourceServer $authorizationSettings = null,
        protected ?string $baseUrl = null,
        protected ?bool $bearerOnly = null,
        protected ?string $clientAuthenticatorType = null,
        protected ?string $clientId = null,
        protected ?bool $consentRequired = null,
        protected ?array $defaultClientScopes = null,
        protected ?string $description = null,
        protected ?bool $directAccessGrantsEnabled = null,
        protected ?bool $enabled = null,
        protected ?bool $frontchannelLogout = null,
        protected ?bool $fullScopeAllowed = null,
        protected ?string $id = null,
        protected ?bool $implicitFlowEnabled = null,
        protected ?string $name = null,
        protected ?int $nodeReRegistrationTimeout = null,
        protected ?int $notBefore = null,
        protected ?bool $oauth2DeviceAuthorizationGrantEnabled = null,
        protected ?array $optionalClientScopes = null,
        protected ?string $origin = null,
        protected ?string $protocol = null,
        protected ?ProtocolMapperCollection $protocolMappers = null,
        protected ?bool $publicClient = null,
        protected ?array $redirectUris = null,
        protected ?Map $registeredNodes = null,
        protected ?string $registrationAccessToken = null,
        protected ?string $rootUrl = null,
        protected ?string $secret = null,
        protected ?bool $serviceAccountsEnabled = null,
        protected ?bool $standardFlowEnabled = null,
        protected ?bool $surrogateAuthRequired = null,
        protected ?array $webOrigins = null,
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
            $id,
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
