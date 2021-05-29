<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

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
 * @method ?array getAttributes()
 * @method ?array getAuthenticationFlows()
 * @method ?array getAuthenticatorConfig()
 * @method string|null getBrowserFlow()
 * @method ?array getBrowserSecurityHeaders()
 * @method bool|null getBruteForceProtected()
 * @method string|null getClientAuthenticationFlow()
 * @method int|null getClientOfflineSessionIdleTimeout()
 * @method int|null getClientOfflineSessionMaxLifespan()
 * @method ?ClientPolicies getClientPolicies()
 * @method ?ClientProfiles getClientProfiles()
 * @method ?array getClientScopeMappings()
 * @method ?array getClientScopes()
 * @method int|null getClientSessionIdleTimeout()
 * @method int|null getClientSessionMaxLifespan()
 * @method ?array getClients()
 * @method ?array getComponents()
 * @method ?array getDefaultDefaultClientScopes()
 * @method ?array getDefaultGroups()
 * @method string|null getDefaultLocale()
 * @method ?array getDefaultOptionalClientScopes()
 * @method ?Role getDefaultRole()
 * @method string|null getDefaultSignatureAlgorithm()
 * @method string|null getDirectGrantFlow()
 * @method string|null getDisplayName()
 * @method string|null getDisplayNameHtml()
 * @method string|null getDockerAuthenticationFlow()
 * @method bool|null getDuplicateEmailsAllowed()
 * @method bool|null getEditUsernameAllowed()
 * @method string|null getEmailTheme()
 * @method bool|null getEnabled()
 * @method ?array getEnabledEventTypes()
 * @method bool|null getEventsEnabled()
 * @method int|null getEventsExpiration()
 * @method ?array getEventsListeners()
 * @method int|null getFailureFactor()
 * @method ?array getFederatedUsers()
 * @method ?array getGroups()
 * @method string|null getId()
 * @method ?array getIdentityProviderMappers()
 * @method ?array getIdentityProviders()
 * @method bool|null getInternationalizationEnabled()
 * @method string|null getKeycloakVersion()
 * @method string|null getLoginTheme()
 * @method bool|null getloginWithEmailAllowed()
 * @method int|null getMaxDeltaTimeSeconds()
 * @method int|null getMaxFailureWaitSeconds()
 * @method int|null getMinimumQuickLoginWaitSeconds()
 * @method int|null getNotBefore()
 * @method int|null getOauth2DeviceCodeLifespan()
 * @method int|null getOauth2DevicePollingInterval()
 * @method int|null getOfflineSessionIdleTimeout()
 * @method int|null getOfflineSessionMaxLifespan()
 * @method bool|null getOfflineSessionMaxLifespanEnabled()
 * @method string|null getOtpPolicyAlgorithm()
 * @method int|null getOtpPolicyDigits()
 * @method int|null getOtpPolicyInitialCounter()
 * @method int|null getOtpPolicyLookAheadWindow()
 * @method int|null getOtpPolicyPeriod()
 * @method string|null getOtpPolicyType()
 * @method ?array getOtpSupportedApplications()
 * @method string|null getPasswordPolicy()
 * @method bool|null getPermanentLockout()
 * @method ?array getProtocolMappers()
 * @method int|null getQuickLoginCheckMilliSeconds()
 * @method string|null getRealm()
 * @method int|null getRefreshTokenMaxReuse()
 * @method bool|null getRegistrationAllowed()
 * @method bool|null getRegistrationEmailAsUsername()
 * @method string|null getRegistrationFlow()
 * @method bool|null getRememberMe()
 * @method ?array getRequiredActions()
 * @method ?array getRequiredCredentials()
 * @method string|null getResetCredentialsFlow()
 * @method bool|null getResetPasswordAllowed()
 * @method bool|null getRevokeRefreshToken()
 * @method ?Roles getRoles()
 * @method ?array getScopeMappings()
 * @method ?Map getSmtpServer()
 * @method string|null getSslRequired()
 * @method int|null getSsoSessionIdleTimeout()
 * @method int|null getSsoSessionIdleTimeoutRememberMe()
 * @method int|null getSsoSessionMaxLifespan()
 * @method int|null getSsoSessionMaxLifespanRememberMe()
 * @method ?array getSupportedLocales()
 * @method ?array getUserFederationMappers()
 * @method ?array getUserFederationProviders()
 * @method bool|null getUserManagedAccessAllowed()
 * @method ?array getUsers()
 * @method bool|null getVerifyEmail()
 * @method int|null getWaitIncrementSeconds()
 * @method ?array getWebAuthnPolicyAcceptableAaguids()
 * @method string|null getWebAuthnPolicyAttestationConveyancePreference()
 * @method string|null getWebAuthnPolicyAuthenticatorAttachment()
 * @method bool|null getWebAuthnPolicyAvoidSameAuthenticatorRegister()
 * @method int|null getWebAuthnPolicyCreateTimeout()
 * @method ?array getWebAuthnPolicyPasswordlessAcceptableAaguids()
 * @method string|null getWebAuthnPolicyPasswordlessAttestationConveyancePreference()
 * @method string|null getWebAuthnPolicyPasswordlessAuthenticatorAttachment()
 * @method bool|null getWebAuthnPolicyPasswordlessAvoidSameAuthenticatorRegister()
 * @method int|null getWebAuthnPolicyPasswordlessCreateTimeout()
 * @method string|null getWebAuthnPolicyPasswordlessRequireResidentKey()
 * @method string|null getWebAuthnPolicyPasswordlessRpEntityName()
 * @method string|null getWebAuthnPolicyPasswordlessRpId()
 * @method ?array getWebAuthnPolicyPasswordlessSignatureAlgorithms()
 * @method string|null getWebAuthnPolicyPasswordlessUserVerificationRequirement()
 * @method string|null getWebAuthnPolicyRequireResidentKey()
 * @method string|null getWebAuthnPolicyRpEntityName()
 * @method string|null getWebAuthnPolicyRpId()
 * @method ?array getWebAuthnPolicySignatureAlgorithms()
 * @method string|null getWebAuthnPolicyUserVerificationRequirement()
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
        protected ?array $attributes = null,
        protected ?array $authenticationFlows = null,
        protected ?array $authenticatorConfig = null,
        protected ?string $browserFlow = null,
        protected ?array $browserSecurityHeaders = null,
        protected ?bool $bruteForceProtected = null,
        protected ?string $clientAuthenticationFlow = null,
        protected ?int $clientOfflineSessionIdleTimeout = null,
        protected ?int $clientOfflineSessionMaxLifespan = null,
        protected ?ClientPolicies $clientPolicies = null,
        protected ?ClientProfiles $clientProfiles = null,
        protected ?array $clientScopeMappings = null,
        protected ?array $clientScopes = null,
        protected ?int $clientSessionIdleTimeout = null,
        protected ?int $clientSessionMaxLifespan = null,
        protected ?array $clients = null,
        protected ?array $components = null,
        protected ?array $defaultDefaultClientScopes = null,
        protected ?array $defaultGroups = null,
        protected ?string $defaultLocale = null,
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
        protected ?array $enabledEventTypes = null,
        protected ?bool $eventsEnabled = null,
        protected ?int $eventsExpiration = null,
        protected ?array $eventsListeners = null,
        protected ?int $failureFactor = null,
        protected ?array $federatedUsers = null,
        protected ?array $groups = null,
        protected ?string $id = null,
        protected ?array $identityProviderMappers = null,
        protected ?array $identityProviders = null,
        protected ?bool $internationalizationEnabled = null,
        protected ?string $keycloakVersion = null,
        protected ?string $loginTheme = null,
        protected ?bool $loginWithEmailAllowed = null,
        protected ?int $maxDeltaTimeSeconds = null,
        protected ?int $maxFailureWaitSeconds = null,
        protected ?int $minimumQuickLoginWaitSeconds = null,
        protected ?int $notBefore = null,
        protected ?int $oauth2DeviceCodeLifespan = null,
        protected ?int $oauth2DevicePollingInterval = null,
        protected ?int $offlineSessionIdleTimeout = null,
        protected ?int $offlineSessionMaxLifespan = null,
        protected ?bool $offlineSessionMaxLifespanEnabled = null,
        protected ?string $otpPolicyAlgorithm = null,
        protected ?int $otpPolicyDigits = null,
        protected ?int $otpPolicyInitialCounter = null,
        protected ?int $otpPolicyLookAheadWindow = null,
        protected ?int $otpPolicyPeriod = null,
        protected ?string $otpPolicyType = null,
        protected ?array $otpSupportedApplications = null,
        protected ?string $passwordPolicy = null,
        protected ?bool $permanentLockout = null,
        protected ?array $protocolMappers = null,
        protected ?int $quickLoginCheckMilliSeconds = null,
        protected ?string $realm = null,
        protected ?int $refreshTokenMaxReuse = null,
        protected ?bool $registrationAllowed = null,
        protected ?bool $registrationEmailAsUsername = null,
        protected ?string $registrationFlow = null,
        protected ?bool $rememberMe = null,
        protected ?array $requiredActions = null,
        protected ?array $requiredCredentials = null,
        protected ?string $resetCredentialsFlow = null,
        protected ?bool $resetPasswordAllowed = null,
        protected ?bool $revokeRefreshToken = null,
        protected ?Roles $roles = null,
        protected ?array $scopeMappings = null,
        protected ?Map $smtpServer = null,
        protected ?string $sslRequired = null,
        protected ?int $ssoSessionIdleTimeout = null,
        protected ?int $ssoSessionIdleTimeoutRememberMe = null,
        protected ?int $ssoSessionMaxLifespan = null,
        protected ?int $ssoSessionMaxLifespanRememberMe = null,
        protected ?array $supportedLocales = null,
        protected ?array $userFederationMappers = null,
        protected ?array $userFederationProviders = null,
        protected ?bool $userManagedAccessAllowed = null,
        protected ?array $users = null,
        protected ?bool $verifyEmail = null,
        protected ?int $waitIncrementSeconds = null,
        protected ?array $webAuthnPolicyAcceptableAaguids = null,
        protected ?string $webAuthnPolicyAttestationConveyancePreference = null,
        protected ?string $webAuthnPolicyAuthenticatorAttachment = null,
        protected ?bool $webAuthnPolicyAvoidSameAuthenticatorRegister = null,
        protected ?int $webAuthnPolicyCreateTimeout = null,
        protected ?array $webAuthnPolicyPasswordlessAcceptableAaguids = null,
        protected ?string $webAuthnPolicyPasswordlessAttestationConveyancePreference = null,
        protected ?string $webAuthnPolicyPasswordlessAuthenticatorAttachment = null,
        protected ?bool $webAuthnPolicyPasswordlessAvoidSameAuthenticatorRegister = null,
        protected ?int $webAuthnPolicyPasswordlessCreateTimeout = null,
        protected ?string $webAuthnPolicyPasswordlessRequireResidentKey = null,
        protected ?string $webAuthnPolicyPasswordlessRpEntityName = null,
        protected ?string $webAuthnPolicyPasswordlessRpId = null,
        protected ?array $webAuthnPolicyPasswordlessSignatureAlgorithms = null,
        protected ?string $webAuthnPolicyPasswordlessUserVerificationRequirement = null,
        protected ?string $webAuthnPolicyRequireResidentKey = null,
        protected ?string $webAuthnPolicyRpEntityName = null,
        protected ?string $webAuthnPolicyRpId = null,
        protected ?array $webAuthnPolicySignatureAlgorithms = null,
        protected ?string $webAuthnPolicyUserVerificationRequirement = null,
    ) {
        parent::__construct(
            $accessCodeLifespan,
            $accessCodeLifespanLogin,
            $accessCodeLifespanUserAction,
            $accessTokenLifespan,
            $accessTokenLifespanForImplicitFlow,
            $accountTheme,
            $actionTokenGeneratedByAdminLifespan,
            $actionTokenGeneratedByUserLifespan,
            $adminEventsDetailsEnabled,
            $adminEventsEnabled,
            $adminTheme,
            $attributes,
            $authenticationFlows,
            $authenticatorConfig,
            $browserFlow,
            $browserSecurityHeaders,
            $bruteForceProtected,
            $clientAuthenticationFlow,
            $clientOfflineSessionIdleTimeout,
            $clientOfflineSessionMaxLifespan,
            $clientPolicies,
            $clientProfiles,
            $clientScopeMappings,
            $clientScopes,
            $clientSessionIdleTimeout,
            $clientSessionMaxLifespan,
            $clients,
            $components,
            $defaultDefaultClientScopes,
            $defaultGroups,
            $defaultLocale,
            $defaultOptionalClientScopes,
            $defaultRole,
            $defaultSignatureAlgorithm,
            $directGrantFlow,
            $displayName,
            $displayNameHtml,
            $dockerAuthenticationFlow,
            $duplicateEmailsAllowed,
            $editUsernameAllowed,
            $emailTheme,
            $enabled,
            $enabledEventTypes,
            $eventsEnabled,
            $eventsExpiration,
            $eventsListeners,
            $failureFactor,
            $federatedUsers,
            $groups,
            $id,
            $identityProviderMappers,
            $identityProviders,
            $internationalizationEnabled,
            $keycloakVersion,
            $loginTheme,
            $loginWithEmailAllowed,
            $maxDeltaTimeSeconds,
            $maxFailureWaitSeconds,
            $minimumQuickLoginWaitSeconds,
            $notBefore,
            $oauth2DeviceCodeLifespan,
            $oauth2DevicePollingInterval,
            $offlineSessionIdleTimeout,
            $offlineSessionMaxLifespan,
            $offlineSessionMaxLifespanEnabled,
            $otpPolicyAlgorithm,
            $otpPolicyDigits,
            $otpPolicyInitialCounter,
            $otpPolicyLookAheadWindow,
            $otpPolicyPeriod,
            $otpPolicyType,
            $otpSupportedApplications,
            $passwordPolicy,
            $permanentLockout,
            $protocolMappers,
            $quickLoginCheckMilliSeconds,
            $realm,
            $refreshTokenMaxReuse,
            $registrationAllowed,
            $registrationEmailAsUsername,
            $registrationFlow,
            $rememberMe,
            $requiredActions,
            $requiredCredentials,
            $resetCredentialsFlow,
            $resetPasswordAllowed,
            $revokeRefreshToken,
            $roles,
            $scopeMappings,
            $smtpServer,
            $sslRequired,
            $ssoSessionIdleTimeout,
            $ssoSessionIdleTimeoutRememberMe,
            $ssoSessionMaxLifespan,
            $ssoSessionMaxLifespanRememberMe,
            $supportedLocales,
            $userFederationMappers,
            $userFederationProviders,
            $userManagedAccessAllowed,
            $users,
            $verifyEmail,
            $waitIncrementSeconds,
            $webAuthnPolicyAcceptableAaguids,
            $webAuthnPolicyAttestationConveyancePreference,
            $webAuthnPolicyAuthenticatorAttachment,
            $webAuthnPolicyAvoidSameAuthenticatorRegister,
            $webAuthnPolicyCreateTimeout,
            $webAuthnPolicyPasswordlessAcceptableAaguids,
            $webAuthnPolicyPasswordlessAttestationConveyancePreference,
            $webAuthnPolicyPasswordlessAuthenticatorAttachment,
            $webAuthnPolicyPasswordlessAvoidSameAuthenticatorRegister,
            $webAuthnPolicyPasswordlessCreateTimeout,
            $webAuthnPolicyPasswordlessRequireResidentKey,
            $webAuthnPolicyPasswordlessRpEntityName,
            $webAuthnPolicyPasswordlessRpId,
            $webAuthnPolicyPasswordlessSignatureAlgorithms,
            $webAuthnPolicyPasswordlessUserVerificationRequirement,
            $webAuthnPolicyRequireResidentKey,
            $webAuthnPolicyRpEntityName,
            $webAuthnPolicyRpId,
            $webAuthnPolicySignatureAlgorithms,
            $webAuthnPolicyUserVerificationRequirement,
        );
    }

    public static function from(array $properties): static
    {
        foreach ($properties as $property => $value) {
            if ($property === 'defaultRole') {
                $properties[$property] = Role::from($value);
            }

            if ($property === 'smtpServer') {
                if ($value === null || empty($value)) {
                    $properties[$property] = new Map();

                    continue;
                }

                $properties[$property] = new Map($value);
            }
        }

        return parent::from($properties);
    }
}
