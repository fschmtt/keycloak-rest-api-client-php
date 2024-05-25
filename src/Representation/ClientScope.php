<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Collection\ProtocolMapperCollection;
use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getAttributes()
 * @method self withAttributes(?Map $attributes)
 * @method string|null getDescription()
 * @method self withDescription(?string $description)
 * @method string|null getId()
 * @method self withId(?string $id)
 * @method string|null getName()
 * @method self withName(?string $name)
 * @method string|null getProtocol()
 * @method self withProtocol(?string $protocol)
 * @method ProtocolMapperCollection|null getProtocolMappers()
 * @method self withProtocolMappers(?ProtocolMapperCollection $protocolMappers)
 *
 * @codeCoverageIgnore
 */
class ClientScope extends Representation
{
    public function __construct(
        protected ?Map $attributes = null,
        protected ?string $description = null,
        protected ?string $id = null,
        protected ?string $name = null,
        protected ?string $protocol = null,
        protected ?ProtocolMapperCollection $protocolMappers = null
    ) {
    }
}
