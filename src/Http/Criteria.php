<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

class Criteria
{
    public const BRIEF_REPRESENTATION = 'briefRepresentation';
    public const DATE_FROM = 'dateFrom';
    public const DATE_TO = 'dateTo';
    public const PAGINATION_OFFSET = 'first';
    public const MAX_RESULT_SIZE = 'max';

    public const ADMIN_EVENT_AUTH_CLIENT = 'authClient';
    public const ADMIN_EVENT_AUTH_IP_ADDRESS = 'authIpAddress';
    public const ADMIN_EVENT_AUTH_REALM = 'authRealm';
    public const ADMIN_EVENT_AUTH_USER = 'authUser';
    public const ADMIN_EVENT_OPERATION_TYPES = 'operationTypes';
    public const ADMIN_EVENT_RESOURCE_PATH = 'resourcePath';
    public const ADMIN_EVENT_RESOURCE_TYPE = 'resourceType';

    public const USER_EMAIL = 'email';
    public const USER_EMAIL_VERIFIED = 'emailVerified';
    public const USER_ENABLED = 'enabled';
    public const USER_EXACT = 'exact';
    public const USER_FIRST_NAME = 'firstName';
    public const USER_IDP_ALIAS = 'idpAlias';
    public const USER_IDP_USER_ID = 'idpUserId';
    public const USER_LAST_NAME = 'lastName';
    public const USER_ATTRIBUTES = 'q';
    public const USER_SEARCH = 'search';
    public const USER_USERNAME = 'username';

    public const CLIENT_ID = 'clientId';
    public const CLIENT_ATTRIBUTES = 'q';
    public const CLIENT_SEARCH = 'search';
    public const CLIENT_VIEWABLE_ONLY = 'viewableOnly';

    /**
     * @var array<string, mixed>
     */
    private array $criteria;

    public function __construct(array $criteria = [])
    {
        $this->criteria = $criteria;
    }

    public function jsonSerialize(): array
    {
        $serializable = [];

        foreach ($this->criteria as $key => $value) {
            $serializable[$key] = match (gettype($value)) {
                'boolean' => $value ? 'true' : 'false',
                default => $value,
            };
        }

        return $serializable;
    }
}
