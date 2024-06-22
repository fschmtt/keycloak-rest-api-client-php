<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

/**
 * @internal
 */
enum Method: string
{
    case GET = 'GET';
    case HEAD = 'HEAD';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}
