<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;

/**
 * @method string|null getCryptoProvider()
 * @method self withCryptoProvider(?string $value)
 * @method string[]|null getSupportedKeystoreTypes()
 * @method self withSupportedKeystoreTypes(?array $value)
 *
 * @codeCoverageIgnore
 */
#[Since('20.0.0')]
class CryptoInfo extends Representation
{
    public function __construct(
        protected ?string $cryptoProvider = null,
        /** @var string[]|null */
        protected ?array $supportedKeystoreTypes = null,
    ) {
    }
}
