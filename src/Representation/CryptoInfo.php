<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;

/**
 * @method string|null getCryptoProvider()
 * @method array<string>|null getSupportedKeystoreTypes()
 * @method withCryptoProvider(?string $value)
 * @method array<string>|null withSupportedKeystoreTypes(?array $value)
 *
 * @codeCoverageIgnore
 */
#[Since('20.0.0')]
class CryptoInfo extends Representation
{
    public function __construct(
        protected ?string $cryptoProvider = null,
        protected ?array $supportedKeystoreTypes = null,
    ) {
    }
}
