<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;

/**
 * @method string[]|null getClientSignatureAsymmetricAlgorithms()
 * @method string[]|null getClientSignatureSymmetricAlgorithms()
 * @method string|null getCryptoProvider()
 * @method string[]|null getSupportedKeystoreTypes()
 * @method self withClientSignatureAsymmetricAlgorithms(?array $value)
 * @method self withClientSignatureSymmetricAlgorithms(?array $value)
 * @method self withCryptoProvider(?string $value)
 * @method self withSupportedKeystoreTypes(?array $value)
 *
 * @codeCoverageIgnore
 */
#[Since('20.0.0')]
class CryptoInfo extends Representation
{
    public function __construct(
        /** @var string[]|null */
        #[Since('22.0.0')]
        protected ?array $clientSignatureAsymmetricAlgorithms = null,
        /** @var string[]|null */
        #[Since('22.0.0')]
        protected ?array $clientSignatureSymmetricAlgorithms = null,
        protected ?string $cryptoProvider = null,
        /** @var string[]|null */
        protected ?array $supportedKeystoreTypes = null,
    ) {}
}
