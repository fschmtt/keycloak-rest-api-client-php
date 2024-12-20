<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Attribute\Since;

/**
 * @method string|null getProviderId()
 * @method self withProviderId(?string $providerId)
 *
 * @method int|null getProviderPriority()
 * @method self withProviderPriority(?int $providerPriority)
 *
 * @method string|null getKid()
 * @method self withKid(?string $kid)
 *
 * @method string|null getStatus()
 * @method self withStatus(?string $status)
 *
 * @method string|null getType()
 * @method self withType(?string $type)
 *
 * @method string|null getAlgorithm()
 * @method self withAlgorithm(?string $algorithm)
 *
 * @method string|null getPublicKey()
 * @method self withPublicKey(?string $publicKey)
 *
 * @method string|null getCertificate()
 * @method self withCertificate(?string $certificate)
 *
 * @method string|null getUse()
 * @method self withUse(?string $use)
 *
 * @method int|null getValidTo()
 * @method self withValidTo(?int $validTo)
 *
 * @codeCoverageIgnore
 */
class KeyMetadata extends Representation
{
    public function __construct(
        protected ?string $providerId = null,
        protected ?int $providerPriority = null,
        protected ?string $kid = null,
        protected ?string $status = null,
        protected ?string $type = null,
        protected ?string $algorithm = null,
        protected ?string $publicKey = null,
        protected ?string $certificate = null,
        protected ?string $use = null,
        #[Since('23.0.0')]
        protected ?int $validTo = null,
    ) {}
}
