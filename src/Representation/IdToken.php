<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class IdToken extends Representation
{
    public const ACR = 'acr';
    public const ADDRESS = 'address';
    public const AT_HASH = 'at_hash';
    public const AUTH_TIME = 'auth_time';
    public const BIRTHDATE = 'birthdate';
    public const C_HASH = 'c_hash';
    public const CLAIMS_LOCALES = 'claims_locales';
    public const EMAIL = 'email';
    public const EMAIL_VERIFIED = 'email_verified';
    public const FAMILY_NAME = 'family_name';
    public const GENDER = 'gender';
    public const GIVEN_NAME = 'given_name';
    public const LOCALE = 'locale';
    public const MIDDLE_NAME = 'middle_name';
    public const NAME = 'name';
    public const NICKNAME = 'nickname';
    public const NONCE = 'nonce';
    public const PHONE_NUMBER = 'phone_number';
    public const PHONE_NUMBER_VERIFIED = 'phone_number_verified';
    public const PICTURE = 'picture';
    public const PREFERRED_USERNAME = 'preferred_username';
    public const PROFILE = 'profile';
    public const S_HASH = 's_hash';
    public const SESSION_STATE = 'session_state';
    public const UPDATED_AT = 'updated_at';
    public const WEBSITE = 'website';
    public const ZONEINFO = 'zoneinfo';
}
