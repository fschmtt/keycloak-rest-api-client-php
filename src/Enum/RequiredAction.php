<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Enum;

enum RequiredAction: string implements Enum
{
    case UPDATE_PASSWORD = 'UPDATE_PASSWORD';
    case VERIFY_EMAIL = 'VERIFY_EMAIL';
    case CONFIGURE_OTP = 'CONFIGURE_OTP';
    case CONFIGURE_TOTP = 'CONFIGURE_TOTP';
    case UPDATE_PROFILE = 'UPDATE_PROFILE';
    case UPDATE_USER_LOCALE = 'update_user_locale';
    case VERIFY_PROFILE = 'VERIFY_PROFILE';
    case DELETE_CREDENTIAL = 'delete_credential';
    case WEBAUTHN_REGISTER = 'webauthn-register';
    case WEBAUTHN_REGISTER_PASSWORDLESS = 'webauthn-register-passwordless';
    case TERMS_AND_CONDITIONS = 'TERMS_AND_CONDITIONS';
    case DELETE_ACCOUNT = 'DELETE_ACCOUNT';
}
