<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;
use Fschmtt\Keycloak\Collection\AuthenticationFlowCollection;
use Fschmtt\Keycloak\Collection\AuthenticatorConfigCollection;
use Fschmtt\Keycloak\Collection\ClientCollection;
use Fschmtt\Keycloak\Collection\ClientScopeCollection;
use Fschmtt\Keycloak\Collection\GroupCollection;
use Fschmtt\Keycloak\Collection\IdentityProviderCollection;
use Fschmtt\Keycloak\Collection\IdentityProviderMapperCollection;
use Fschmtt\Keycloak\Collection\OrganizationCollection;
use Fschmtt\Keycloak\Collection\ProtocolMapperCollection;
use Fschmtt\Keycloak\Collection\RequiredActionProviderCollection;
use Fschmtt\Keycloak\Collection\ScopeMappingCollection;
use Fschmtt\Keycloak\Collection\UserCollection;
use Fschmtt\Keycloak\Collection\UserFederationMapperCollection;
use Fschmtt\Keycloak\Collection\UserFederationProviderCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method int|null getAccessCodeLifespan()
 * @method int|null getAccessCodeLifespanLogin()
 * @method int|null getAccessCodeLifespanUserAction()
 * @method int|null getAccessTokenLifespan()
 * @method int|null getAccessTokenLifespanForImplicitFlow()
 * @method string|null getAccountTheme()
 * @method int|null getActionTokenGeneratedByAdminLifespan()
 * @method int|null getActionTokenGeneratedByUserLifespan()
 * @method bool|null getAdminEventsDetailsEnabled()
 * @method bool|null getAdminEventsEnabled()
 * @method string|null getAdminTheme()
 * @method Map|null getAttributes()
 * @method array|null getAuthenticationFlows()
 * @method array|null getAuthenticatorConfig()
 * @method string|null getBrowserFlow()
 * @method array|null getBrowserSecurityHeaders()
 * @method bool|null getBruteForceProtected()
 * @method string|null getClientAuthenticationFlow()
 * @method int|null getClientOfflineSessionIdleTimeout()
 * @method int|null getClientOfflineSessionMaxLifespan()
 * @method ClientPolicies|null getClientPolicies()
 * @method ClientProfiles|null getClientProfiles()
 * @method array|null getClientScopeMappings()
 * @method array|null getClientScopes()
 * @method int|null getClientSessionIdleTimeout()
 * @method int|null getClientSessionMaxLifespan()
 * @method ClientCollection|null getClients()
 * @method array|null getComponents()
 * @method array|null getDefaultDefaultClientScopes()
 * @method array|null getDefaultGroups()
 * @method string|null getDefaultLocale()
 * @method array|null getDefaultOptionalClientScopes()
 * @method Role|null getDefaultRole()
 * @method string|null getDefaultSignatureAlgorithm()
 * @method string|null getDirectGrantFlow()
 * @method string|null getDisplayName()
 * @method string|null getDisplayNameHtml()
 * @method string|null getDockerAuthenticationFlow()
 * @method bool|null getDuplicateEmailsAllowed()
 * @method bool|null getEditUsernameAllowed()
 * @method string|null getEmailTheme()
 * @method bool|null getEnabled()
 * @method array|null getEnabledEventTypes()
 * @method bool|null getEventsEnabled()
 * @method int|null getEventsExpiration()
 * @method array|null getEventsListeners()
 * @method int|null getFailureFactor()
 * @method UserCollection|null getFederatedUsers()
 * @method string|null getFirstBrokerLoginFlow()
 * @method GroupCollection|null getGroups()
 * @method string|null getId()
 * @method array|null getIdentityProviderMappers()
 * @method array|null getIdentityProviders()
 * @method bool|null getInternationalizationEnabled()
 * @method string|null getKeycloakVersion()
 * @method string|null getLoginTheme()
 * @method bool|null getLoginWithEmailAllowed()
 * @method int|null getMaxDeltaTimeSeconds()
 * @method int|null getMaxFailureWaitSeconds()
 * @method int|null getMaxTemporaryLockouts()
 * @method int|null getMinimumQuickLoginWaitSeconds()
 * @method int|null getNotBefore()
 * @method int|null getOauth2DeviceCodeLifespan()
 * @method int|null getOauth2DevicePollingInterval()
 * @method int|null getOfflineSessionIdleTimeout()
 * @method int|null getOfflineSessionMaxLifespan()
 * @method bool|null getOfflineSessionMaxLifespanEnabled()
 * @method string|null getOtpPolicyAlgorithm()
 * @method bool|null getOtpPolicyCodeReusable()
 * @method int|null getOtpPolicyDigits()
 * @method int|null getOtpPolicyInitialCounter()
 * @method int|null getOtpPolicyLookAheadWindow()
 * @method int|null getOtpPolicyPeriod()
 * @method string|null getOtpPolicyType()
 * @method array|null getOtpSupportedApplications()
 * @method string|null getPasswordPolicy()
 * @method bool|null getPermanentLockout()
 * @method array|null getProtocolMappers()
 * @method int|null getQuickLoginCheckMilliSeconds()
 * @method string|null getRealm()
 * @method int|null getRefreshTokenMaxReuse()
 * @method bool|null getRegistrationAllowed()
 * @method bool|null getRegistrationEmailAsUsername()
 * @method string|null getRegistrationFlow()
 * @method bool|null getRememberMe()
 * @method array|null getRequiredActions()
 * @method string[]|null getRequiredCredentials()
 * @method string|null getResetCredentialsFlow()
 * @method bool|null getResetPasswordAllowed()
 * @method bool|null getRevokeRefreshToken()
 * @method Roles|null getRoles()
 * @method array|null getScopeMappings()
 * @method Map|null getSmtpServer()
 * @method string|null getSslRequired()
 * @method int|null getSsoSessionIdleTimeout()
 * @method int|null getSsoSessionIdleTimeoutRememberMe()
 * @method int|null getSsoSessionMaxLifespan()
 * @method int|null getSsoSessionMaxLifespanRememberMe()
 * @method string[]|null getSupportedLocales()
 * @method array|null getUserFederationMappers()
 * @method array|null getUserFederationProviders()
 * @method bool|null getUserManagedAccessAllowed()
 * @method array|null getUsers()
 * @method bool|null getVerifyEmail()
 * @method int|null getWaitIncrementSeconds()
 * @method array|null getWebAuthnPolicyAcceptableAaguids()
 * @method string|null getWebAuthnPolicyAttestationConveyancePreference()
 * @method string|null getWebAuthnPolicyAuthenticatorAttachment()
 * @method bool|null getWebAuthnPolicyAvoidSameAuthenticatorRegister()
 * @method int|null getWebAuthnPolicyCreateTimeout()
 * @method string[]|null getWebAuthnPolicyExtraOrigins()
 * @method array|null getWebAuthnPolicyPasswordlessAcceptableAaguids()
 * @method string|null getWebAuthnPolicyPasswordlessAttestationConveyancePreference()
 * @method string|null getWebAuthnPolicyPasswordlessAuthenticatorAttachment()
 * @method bool|null getWebAuthnPolicyPasswordlessAvoidSameAuthenticatorRegister()
 * @method int|null getWebAuthnPolicyPasswordlessCreateTimeout()
 * @method string[]|null getWebAuthnPolicyPasswordlessPolicyExtraOrigins()
 * @method string|null getWebAuthnPolicyPasswordlessRequireResidentKey()
 * @method string|null getWebAuthnPolicyPasswordlessRpEntityName()
 * @method string|null getWebAuthnPolicyPasswordlessRpId()
 * @method array|null getWebAuthnPolicyPasswordlessSignatureAlgorithms()
 * @method string|null getWebAuthnPolicyPasswordlessUserVerificationRequirement()
 * @method string|null getWebAuthnPolicyRequireResidentKey()
 * @method string|null getWebAuthnPolicyRpEntityName()
 * @method string|null getWebAuthnPolicyRpId()
 * @method array|null getWebAuthnPolicySignatureAlgorithms()
 * @method string|null getWebAuthnPolicyUserVerificationRequirement()
 * @method self withAccessCodeLifespan(?int $accessCodeLifespan)
 * @method self withAccessCodeLifespanLogin(?int $accessCodeLifespanLogin)
 * @method self withAccessCodeLifespanUserAction(?int $accessCodeLifespanUserAction)
 * @method self withAccessTokenLifespan(?int $accessTokenLifespan)
 * @method self withAccessTokenLifespanForImplicitFlow(?int $value)
 * @method self withAccountTheme(?string $value)
 * @method self withActionTokenGeneratedByAdminLifespan(?int $value)
 * @method self withActionTokenGeneratedByUserLifespan(?int $value)
 * @method self withAdminEventsDetailsEnabled(?bool $value)
 * @method self withAdminEventsEnabled(?bool $value)
 * @method self withAdminTheme(?string $value)
 * @method self withAttributes(?Map $value)
 * @method self withAuthenticationFlows(?array $value)
 * @method self withAuthenticatorConfig(?array $value)
 * @method self withBrowserFlow(?string $value)
 * @method self withBrowserSecurityHeaders(?array $value)
 * @method self withBruteForceProtected(?bool $value)
 * @method self withClientAuthenticationFlow(?string $value)
 * @method self withClientOfflineSessionIdleTimeout(?int $value)
 * @method self withClientOfflineSessionMaxLifespan(?int $value)
 * @method self withClientPolicies(?ClientPolicies $value)
 * @method self withClientProfiles(?ClientProfiles $value)
 * @method self withClientScopeMappings(?array $value)
 * @method self withClientScopes(?array $value)
 * @method self withClientSessionIdleTimeout(?int $value)
 * @method self withClientSessionMaxLifespan(?int $value)
 * @method self withClients(?ClientCollection $value)
 * @method self withComponents(?array $value)
 * @method self withDefaultDefaultClientScopes(?array $value)
 * @method self withDefaultGroups(?array $value)
 * @method self withDefaultLocale(?string $value)
 * @method self withDefaultOptionalClientScopes(?array $value)
 * @method self withDefaultRole(?Role $value)
 * @method self withDefaultSignatureAlgorithm(?string $value)
 * @method self withDirectGrantFlow(?string $value)
 * @method self withDisplayName(?string $value)
 * @method self withDisplayNameHtml(?string $value)
 * @method self withDockerAuthenticationFlow(?string $value)
 * @method self withDuplicateEmailsAllowed(?bool $value)
 * @method self withEditUsernameAllowed(?bool $value)
 * @method self withEmailTheme(?string $value)
 * @method self withEnabled(?bool $value)
 * @method self withEnabledEventTypes(?array $value)
 * @method self withEventsEnabled(?bool $value)
 * @method self withEventsExpiration(?int $value)
 * @method self withEventsListeners(?array $value)
 * @method self withFailureFactor(?int $value)
 * @method self withFederatedUsers(?UserCollection $value)
 * @method self withFirstBrokerLoginFlow(?string $value)
 * @method self withGroups(?GroupCollection $value)
 * @method self withId(?string $value)
 * @method self withIdentityProviderMappers(?array $value)
 * @method self withIdentityProviders(?array $value)
 * @method self withInternationalizationEnabled(?bool $value)
 * @method self withKeycloakVersion(?string $value)
 * @method self withLoginTheme(?string $value)
 * @method self withLoginWithEmailAllowed(?bool $value)
 * @method self withMaxDeltaTimeSeconds(?int $value)
 * @method self withMaxFailureWaitSeconds(?int $value)
 * @method self withMaxTemporaryLockouts(?int $value)
 * @method self withMinimumQuickLoginWaitSeconds(?int $value)
 * @method self withNotBefore(?int $value)
 * @method self withOauth2DeviceCodeLifespan(?int $value)
 * @method self withOauth2DevicePollingInterval(?int $value)
 * @method self withOfflineSessionIdleTimeout(?int $value)
 * @method self withOfflineSessionMaxLifespan(?int $value)
 * @method self withOfflineSessionMaxLifespanEnabled(?int $value)
 * @method self withOtpPolicyAlgorithm(?string $value)
 * @method self withOtpPolicyCodeReusable(?bool $value)
 * @method self withOtpPolicyDigits(?int $value)
 * @method self withOtpPolicyInitialCounter(?int $value)
 * @method self withOtpPolicyLookAheadWindow(?int $value)
 * @method self withOtpPolicyPeriod(?int $value)
 * @method self withOtpPolicyType(?int $value)
 * @method self withOtpSupportedApplications(?array $value)
 * @method self withPasswordPolicy(?string $value)
 * @method self withPermanentLockout(?bool $value)
 * @method self withProtocolMappers(?array $value)
 * @method self withQuickLoginCheckMilliSeconds(?int $value)
 * @method self withRealm(?string $value)
 * @method self withRefreshTokenMaxReuse(?int $value)
 * @method self withRegistrationAllowed(?bool $value)
 * @method self withRegistrationEmailAsUsername(?bool $value)
 * @method self withRegistrationFlow(?string $value)
 * @method self withRememberMe(?bool $value)
 * @method self withRequiredActions(?array $value)
 * @method self withRequiredCredentials(?array $value)
 * @method self withResetCredentialsFlow(?string $value)
 * @method self withResetPasswordAllowed(?bool $value)
 * @method self withRevokeRefreshToken(?bool $value)
 * @method self withRoles(?Roles $value)
 * @method self withScopeMappings(?array $value)
 * @method self withSmtpServer(?Map $value)
 * @method self withSslRequired(?string $value)
 * @method self withSsoSessionIdleTimeout(?int $value)
 * @method self withSsoSessionIdleTimeoutRememberMe(?int $value)
 * @method self withSsoSessionMaxLifespan(?int $value)
 * @method self withSsoSessionMaxLifespanRememberMe(?int $value)
 * @method self withSupportedLocales(?array $value)
 * @method self withUserFederationMappers(?array $value)
 * @method self withUserFederationProviders(?array $value)
 * @method self withUserManagedAccessAllowed(?bool $value)
 * @method self withUsers(?array $value)
 * @method self withVerifyEmail(?bool $value)
 * @method self withWaitIncrementSeconds(?int $value)
 * @method self withWebAuthnPolicyAcceptableAaguids(?array $value)
 * @method self withWebAuthnPolicyAttestationConveyancePreference(?string $value)
 * @method self withWebAuthnPolicyAuthenticatorAttachment(?string $value)
 * @method self withWebAuthnPolicyAvoidSameAuthenticatorRegister(?bool $value)
 * @method self withWebAuthnPolicyCreateTimeout(?int $value)
 * @method self withWebAuthnPolicyExtraOrigins(?array $value)
 * @method self withWebAuthnPolicyPasswordlessAcceptableAaguids(?array $value)
 * @method self withWebAuthnPolicyPasswordlessAttestationConveyancePreference(?string $value)
 * @method self withWebAuthnPolicyPasswordlessAuthenticatorAttachment(?string $value)
 * @method self withWebAuthnPolicyPasswordlessAvoidSameAuthenticatorRegister(?bool $value)
 * @method self withWebAuthnPolicyPasswordlessCreateTimeout(?int $value)
 * @method self withWebAuthnPolicyPasswordlessExtraOrigins(?array $value)
 * @method self withWebAuthnPolicyPasswordlessRequireResidentKey(?string $value)
 * @method self withWebAuthnPolicyPasswordlessRpEntityName(?string $value)
 * @method self withWebAuthnPolicyPasswordlessRpId(?string $value)
 * @method self withWebAuthnPolicyPasswordlessSignatureAlgorithms(?array $value)
 * @method self withWebAuthnPolicyPasswordlessUserVerificationRequirement(?string $value)
 * @method self withWebAuthnPolicyRequireResidentKey(?string $value)
 * @method self withWebAuthnPolicyRpEntityName(?string $value)
 * @method self withWebAuthnPolicyRpId(?string $value)
 * @method self withWebAuthnPolicySignatureAlgorithms(?array $value)
 * @method self withWebAuthnPolicyUserVerificationRequirement(?string $value)
 *
 * @codeCoverageIgnore
 */
class Realm extends Representation
{
    public function __construct(
        protected ?int $accessCodeLifespan = null,
        protected ?int $accessCodeLifespanLogin = null,
        protected ?int $accessCodeLifespanUserAction = null,
        protected ?int $accessTokenLifespan = null,
        protected ?int $accessTokenLifespanForImplicitFlow = null,
        protected ?string $accountTheme = null,
        protected ?int $actionTokenGeneratedByAdminLifespan = null,
        protected ?int $actionTokenGeneratedByUserLifespan = null,
        protected ?bool $adminEventsDetailsEnabled = null,
        protected ?bool $adminEventsEnabled = null,
        protected ?string $adminTheme = null,
        protected ?Map $attributes = null,
        protected ?AuthenticationFlowCollection $authenticationFlows = null,
        protected ?AuthenticatorConfigCollection $authenticatorConfig = null,
        protected ?string $browserFlow = null,
        protected ?Map $browserSecurityHeaders = null,
        protected ?bool $bruteForceProtected = null,
        protected ?string $clientAuthenticationFlow = null,
        protected ?int $clientOfflineSessionIdleTimeout = null,
        protected ?int $clientOfflineSessionMaxLifespan = null,
        protected ?ClientPolicies $clientPolicies = null,
        protected ?ClientProfiles $clientProfiles = null,
        protected ?Map $clientScopeMappings = null,
        protected ?ClientScopeCollection $clientScopes = null,
        protected ?int $clientSessionIdleTimeout = null,
        protected ?int $clientSessionMaxLifespan = null,
        protected ?ClientCollection $clients = null,
        protected ?MultivaluedHashMap $components = null,
        /** @var string[]|null */
        protected ?array $defaultDefaultClientScopes = null,
        /** @var string[]|null */
        protected ?array $defaultGroups = null,
        protected ?string $defaultLocale = null,
        /** @var string[]|null */
        protected ?array $defaultOptionalClientScopes = null,
        protected ?Role $defaultRole = null,
        protected ?string $defaultSignatureAlgorithm = null,
        protected ?string $directGrantFlow = null,
        protected ?string $displayName = null,
        protected ?string $displayNameHtml = null,
        protected ?string $dockerAuthenticationFlow = null,
        protected ?bool $duplicateEmailsAllowed = null,
        protected ?bool $editUsernameAllowed = null,
        protected ?string $emailTheme = null,
        protected ?bool $enabled = null,
        /** @var string[]|null */
        protected ?array $enabledEventTypes = null,
        protected ?bool $eventsEnabled = null,
        protected ?int $eventsExpiration = null,
        /** @var string[]|null */
        protected ?array $eventsListeners = null,
        protected ?int $failureFactor = null,
        protected ?UserCollection $federatedUsers = null,
        #[Since('24.0.0')]
        protected ?string $firstBrokerLoginFlow = null,
        protected ?GroupCollection $groups = null,
        protected ?string $id = null,
        protected ?IdentityProviderMapperCollection $identityProviderMappers = null,
        protected ?IdentityProviderCollection $identityProviders = null,
        protected ?bool $internationalizationEnabled = null,
        protected ?string $keycloakVersion = null,
        protected ?string $loginTheme = null,
        protected ?bool $loginWithEmailAllowed = null,
        protected ?int $maxDeltaTimeSeconds = null,
        protected ?int $maxFailureWaitSeconds = null,
        #[Since('24.0.0')]
        protected ?int $maxTemporaryLockouts = null,
        protected ?int $minimumQuickLoginWaitSeconds = null,
        protected ?int $notBefore = null,
        protected ?int $oauth2DeviceCodeLifespan = null,
        protected ?int $oauth2DevicePollingInterval = null,
        protected ?int $offlineSessionIdleTimeout = null,
        protected ?int $offlineSessionMaxLifespan = null,
        protected ?bool $offlineSessionMaxLifespanEnabled = null,
        #[Since('25.0.0')]
        protected ?OrganizationCollection $organizations = null,
        #[Since('25.0.0')]
        protected ?bool $organizationsEnabled = null,
        protected ?string $otpPolicyAlgorithm = null,
        #[Since('20.0.0')]
        protected ?bool $otpPolicyCodeReusable = null,
        protected ?int $otpPolicyDigits = null,
        protected ?int $otpPolicyInitialCounter = null,
        protected ?int $otpPolicyLookAheadWindow = null,
        protected ?int $otpPolicyPeriod = null,
        protected ?string $otpPolicyType = null,
        /** @var string[]|null */
        protected ?array $otpSupportedApplications = null,
        protected ?string $passwordPolicy = null,
        protected ?bool $permanentLockout = null,
        protected ?ProtocolMapperCollection $protocolMappers = null,
        protected ?int $quickLoginCheckMilliSeconds = null,
        protected ?string $realm = null,
        protected ?int $refreshTokenMaxReuse = null,
        protected ?bool $registrationAllowed = null,
        protected ?bool $registrationEmailAsUsername = null,
        protected ?string $registrationFlow = null,
        protected ?bool $rememberMe = null,
        protected ?RequiredActionProviderCollection $requiredActions = null,
        /** @var string[]|null */
        protected ?array $requiredCredentials = null,
        protected ?string $resetCredentialsFlow = null,
        protected ?bool $resetPasswordAllowed = null,
        protected ?bool $revokeRefreshToken = null,
        protected ?Roles $roles = null,
        protected ?ScopeMappingCollection $scopeMappings = null,
        protected ?Map $smtpServer = null,
        protected ?string $sslRequired = null,
        protected ?int $ssoSessionIdleTimeout = null,
        protected ?int $ssoSessionIdleTimeoutRememberMe = null,
        protected ?int $ssoSessionMaxLifespan = null,
        protected ?int $ssoSessionMaxLifespanRememberMe = null,
        /** @var string[]|null */
        protected ?array $supportedLocales = null,
        protected ?UserFederationMapperCollection $userFederationMappers = null,
        protected ?UserFederationProviderCollection $userFederationProviders = null,
        protected ?bool $userManagedAccessAllowed = null,
        protected ?UserCollection $users = null,
        protected ?bool $verifyEmail = null,
        protected ?int $waitIncrementSeconds = null,
        /** @var string[]|null */
        protected ?array $webAuthnPolicyAcceptableAaguids = null,
        protected ?string $webAuthnPolicyAttestationConveyancePreference = null,
        protected ?string $webAuthnPolicyAuthenticatorAttachment = null,
        protected ?bool $webAuthnPolicyAvoidSameAuthenticatorRegister = null,
        protected ?int $webAuthnPolicyCreateTimeout = null,
        /** @var string[]|null */
        #[Since('23.0.0')]
        protected ?array $webAuthnPolicyExtraOrigins = null,
        /** @var string[]|null */
        protected ?array $webAuthnPolicyPasswordlessAcceptableAaguids = null,
        protected ?string $webAuthnPolicyPasswordlessAttestationConveyancePreference = null,
        protected ?string $webAuthnPolicyPasswordlessAuthenticatorAttachment = null,
        protected ?bool $webAuthnPolicyPasswordlessAvoidSameAuthenticatorRegister = null,
        protected ?int $webAuthnPolicyPasswordlessCreateTimeout = null,
        /** @var string[]|null */
        #[Since('23.0.0')]
        protected ?array $webAuthnPolicyPasswordlessExtraOrigins = null,
        protected ?string $webAuthnPolicyPasswordlessRequireResidentKey = null,
        protected ?string $webAuthnPolicyPasswordlessRpEntityName = null,
        protected ?string $webAuthnPolicyPasswordlessRpId = null,
        /** @var string[]|null */
        protected ?array $webAuthnPolicyPasswordlessSignatureAlgorithms = null,
        protected ?string $webAuthnPolicyPasswordlessUserVerificationRequirement = null,
        protected ?string $webAuthnPolicyRequireResidentKey = null,
        protected ?string $webAuthnPolicyRpEntityName = null,
        protected ?string $webAuthnPolicyRpId = null,
        /** @var string[]|null */
        protected ?array $webAuthnPolicySignatureAlgorithms = null,
        protected ?string $webAuthnPolicyUserVerificationRequirement = null,
    ) {
    }
}
