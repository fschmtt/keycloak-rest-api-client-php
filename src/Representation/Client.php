<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ProtocolMapperCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAccess()
 * @method self withAccess(?Map $access)
 *
 * @method string|null getAdminUrl()
 * @method self withAdminUrl(?string $adminUrl)
 *
 * @method bool|null getAlwaysDisplayInConsole()
 * @method self withAlwaysDisplayInConsole(?bool $alwaysDisplayInConsole)
 *
 * @method Map|null getAttributes()
 * @method self withAttributes(?Map $attributes)
 *
 * @method Map|null getAuthenticationFlowBindingOverrides()
 * @method self withAuthenticationFlowBindingOverrides(?Map $authenticationFlowBindingOverrides)
 *
 * @method bool|null getAuthorizationServicesEnabled()
 * @method self withAuthorizationServicesEnabled(?bool $authorizationServicesEnabled)
 *
 * @method ResourceServer|null getAuthorizationSettings()
 * @method self withAuthorizationSettings(?ResourceServer $authorizationSettings)
 *
 * @method string|null getBaseUrl()
 * @method self withBaseUrl(?string $baseUrl)
 *
 * @method bool|null getBearerOnly()
 * @method self withBearerOnly(?bool $bearerOnly)
 *
 * @method string|null getClientAuthenticatorType()
 * @method self withClientAuthenticatorType(?string $clientAuthenticatorType)
 *
 * @method string|null getClientId()
 * @method self withClientId(?string $clientId)
 *
 * @method bool|null getConsentRequired()
 * @method self withConsentRequired(?bool $consentRequired)
 *
 * @method string[]|null getDefaultClientScopes()
 * @method self withDefaultClientScopes(?string[] $defaultClientScopes)
 *
 * @method string|null getDescription()
 * @method self withDescription(?string $description)
 *
 * @method bool|null getDirectAccessGrantsEnabled()
 * @method self withDirectAccessGrantsEnabled(?bool $directAccessGrantsEnabled)
 *
 * @method bool|null getEnabled()
 * @method self withEnabled(?bool $enabled)
 *
 * @method bool|null getFrontchannelLogout()
 * @method self withFrontchannelLogout(?bool $frontchannelLogout)
 *
 * @method bool|null getFullScopeAllowed()
 * @method self withFullScopeAllowed(?bool $fullScopeAllowed)
 *
 * @method string|null getId()
 * @method self withId(?string $id)
 *
 * @method bool|null getImplicitFlowEnabled()
 * @method self withImplicitFlowEnabled(?bool $implicitFlowEnabled)
 *
 * @method string|null getName()
 * @method self withName(?string $name)
 *
 * @method int|null getNodeReRegistrationTimeout()
 * @method self withNodeReRegistrationTimeout(?int $nodeReRegistrationTimeout)
 *
 * @method int|null getNotBefore()
 * @method self withNotBefore(?int $notBefore)
 *
 * @method string[]|null getOptionalClientScopes()
 * @method self withOptionalClientScopes(?string[] $optionalClientScopes)
 *
 * @method string|null getOrigin()
 * @method self withOrigin(?string $origin)
 *
 * @method string|null getProtocol()
 * @method self withProtocol(?string $protocol)
 *
 * @method ProtocolMapperCollection|null getProtocolMappers()
 * @method self withProtocolMappers(?ProtocolMapperCollection $protocolMappers)
 *
 * @method bool|null getPublicClient()
 * @method self withPublicClient(?bool $publicClient)
 *
 * @method string[]|null getRedirectUris()
 * @method self withRedirectUris(?string[] $redirectUris)
 *
 * @method Map|null getRegisteredNodes()
 * @method self withRegisteredNodes(?Map $registeredNodes)
 *
 * @method string|null getRegistrationAccessToken()
 * @method self withRegistrationAccessToken(?string $registrationAccessToken)
 *
 * @method string|null getRootUrl()
 * @method self withRootUrl(?string $rootUrl)
 *
 * @method string|null getSecret()
 * @method self withSecret(?string $secret)
 *
 * @method bool|null getServiceAccountsEnabled()
 * @method self withServiceAccountsEnabled(?bool $serviceAccountsEnabled)
 *
 * @method bool|null getStandardFlowEnabled()
 * @method self withStandardFlowEnabled(?bool $standardFlowEnabled)
 *
 * @method bool|null getSurrogateAuthRequired()
 * @method self withSurrogateAuthRequired(?bool $surrogateAuthRequired)
 *
 * @method string[]|null getWebOrigins()
 * @method self withWebOrigins(?string[] $webOrigins)
 *
 * @codeCoverageIgnore
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
        /** @var string[]|null */
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
        /** @var string[]|null */
        protected ?array $optionalClientScopes = null,
        protected ?string $origin = null,
        protected ?string $protocol = null,
        protected ?ProtocolMapperCollection $protocolMappers = null,
        protected ?bool $publicClient = null,
        /** @var string[]|null */
        protected ?array $redirectUris = null,
        protected ?Map $registeredNodes = null,
        protected ?string $registrationAccessToken = null,
        protected ?string $rootUrl = null,
        protected ?string $secret = null,
        protected ?bool $serviceAccountsEnabled = null,
        protected ?bool $standardFlowEnabled = null,
        protected ?bool $surrogateAuthRequired = null,
        /** @var string[]|null */
        protected ?array $webOrigins = null,
    ) {}
}
