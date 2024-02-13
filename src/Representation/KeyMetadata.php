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
 * @method self withProviderId()
 * @method self withProviderPriority()
 * @method self withKid()
 * @method self withStatus()
 * @method self withType()
 * @method self withAlgorithm()
 * @method self withPublicKey()
 * @method self withCertificate()
 * @method self withUse()
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
