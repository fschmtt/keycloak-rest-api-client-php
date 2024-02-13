<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getProviderId()
 * @method int|null getProviderPriority()
 * @method string|null getKid()
 * @method string|null getStatus()
 * @method string|null getType()
 * @method string|null getAlgorithm()
 * @method string|null getPublicKey()
 * @method string|null getCertificate()
 * @method string|null getUse()
 * @method self withProviderId(?string $providerId)
 * @method self withProviderPriority(?int $providerPriority)
 * @method self withKid(?string $kid)
 * @method self withStatus(?string $status)
 * @method self withType(?string $type)
 * @method self withAlgorithm(?string $algorithm)
 * @method self withPublicKey(?string $publicKey)
 * @method self withCertificate(?string $certificate)
 * @method self withUse(?string $use)
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
    ) {
    }
}
