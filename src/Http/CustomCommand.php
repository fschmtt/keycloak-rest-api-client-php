<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use Fschmtt\Keycloak\Collection\Collection;
use Fschmtt\Keycloak\Representation\Representation;

class CustomCommand extends Command
{
    /**
     * @param Representation|Collection|array<mixed>|null $payload
     */
    public function __construct(
        string $path,
        Method $method,
        Representation|Collection|array|null $payload = null,
    ) {
        parent::__construct($path, $method, [], $payload);
    }
}
