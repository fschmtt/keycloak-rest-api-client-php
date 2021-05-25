<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class AccessToken extends Representation
{
    protected ?string $acr;

    protected ?AddressClaimSet $address;

    /**
     * @var string[]|null
     */
    protected ?array $allowed_origins;

    protected ?string $at_hash;

    protected ?int $auth_time;

    protected ?AccessTokenAuthorization $authorization;

    protected ?string $azp;

    protected ?string $birthdate;

    protected ?string $c_hash;

    protected ?string $category;

    protected ?string $claims_locales;

    protected ?AccessTokenCertConf $cnf;

    protected ?string $email;

    protected ?bool $emailVerified;

    protected ?int $exp;

    protected ?string $family_name;

    protected ?string $gender;

    protected ?string $given_name;

    protected ?int $iat;

    protected ?string $iss;

    protected ?string $jti;

    protected ?string $locale;

    protected ?string $middle_name;

    protected ?string $name;

    protected ?int $nbf;

    protected ?string $nickname;

    protected ?string $nonce;

    protected ?array $otherClaims;

    protected ?string $phone_number;

    protected ?bool $phone_number_verified;

    protected ?string $picture;

    protected ?string $preferred_username;

    protected ?string $profile;

    protected ?AccessTokenAccess $realm_access;

    protected ?string $s_hash;

    protected ?string $scope;

    protected ?string $session_state;

    protected ?string $sub;

    /**
     * @var string[]|null
     */
    protected ?array $trusted_certs;

    protected ?string $typ;

    protected ?int $updated_at;

    protected ?string $website;

    protected ?string $zoneinfo;
}
