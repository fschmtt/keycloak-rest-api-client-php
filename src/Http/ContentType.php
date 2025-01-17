<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

/**
 * @internal
 */
enum ContentType: string
{
    case JSON = 'application/json';
    case FORM_PARAMS = 'application/x-www-form-urlencoded';
}
