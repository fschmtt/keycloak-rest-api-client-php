<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @since 20.0.0
 * @method string|null getCryptoProvider()
 * @method array<string>|null getSupportedKeystoreTypes()
 * @method withCryptoProvider(?string $value)
 * @method array<string>|null withSupportedKeystoreTypes(?array $value)
 */
class CryptoInfo extends Representation
{
    public function __construct(
        protected ?string $cryptoProvider = null,
        protected ?array $supportedKeystoreTypes = null,
    ) {
        parent::__construct(
            $cryptoProvider,
            $supportedKeystoreTypes
        );
    }
}
