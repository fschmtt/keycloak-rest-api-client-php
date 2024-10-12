<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getConfig()
 * @method bool|null getConsentRequired()
 * @method string getId()
 * @method string getName()
 * @method string getProtocol()
 * @method string getProtocolMapper()
 * @method self withConfig(?Map $config)
 * @method self withConsentRequired(?bool $consentRequired)
 * @method self withId(?string $id)
 * @method self withName(?string $name)
 * @method self withProtocol(?string $protocol)
 * @method self withProtocolMapper(?string $protocolMapper)
 *
 * @codeCoverageIgnore
 */
class ProtocolMapper extends Representation
{
    public function __construct(
        protected ?Map $config = null,
        protected ?bool $consentRequired = null,
        protected ?string $id = null,
        protected ?string $name = null,
        protected ?string $protocol = null,
        protected ?string $protocolMapper = null,
    ) {}
}
