<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getConfig()
 * @method string getId()
 * @method string getName()
 * @method string getProtocol()
 * @method string getProtocolMapper()
 * @method withConfig(?Map $config)
 * @method withId(?string $id)
 * @method withName(?string $name)
 * @method withProtocol(?string $protocol)
 * @method withProtocolMapper(?string $protocolMapper)
 */
class ProtocolMapper extends Representation
{
    public function __construct(
        ?Map $config,
        ?string $id,
        ?string $name,
        ?string $protocol,
        ?string $protocolMapper,
    ) {
        parent::__construct(
            $config,
            $id,
            $name,
            $protocol,
            $protocolMapper,
        );
    }
}
