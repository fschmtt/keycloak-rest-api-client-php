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
 * @method self withConfig(?Map $config)
 * @method self withId(?string $id)
 * @method self withName(?string $name)
 * @method self withProtocol(?string $protocol)
 * @method self withProtocolMapper(?string $protocolMapper)
 */
class ProtocolMapper extends Representation
{
    public function __construct(
        protected ?Map $config,
        protected ?string $id,
        protected ?string $name,
        protected ?string $protocol,
        protected ?string $protocolMapper,
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
