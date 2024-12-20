<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method Map|null getConfig()
 * @method self withConfig(?Map $config)
 *
 * @method bool|null getConsentRequired()
 * @method self withConsentRequired(?bool $consentRequired)
 *
 * @method string getId()
 * @method self withId(?string $id)
 *
 * @method string getName()
 * @method self withName(?string $name)
 *
 * @method string getProtocol()
 * @method self withProtocol(?string $protocol)
 *
 * @method string getProtocolMapper()
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
