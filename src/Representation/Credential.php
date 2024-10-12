<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method int|null getCreatedDate()
 * @method string|null getCredentialData()
 * @method string|null getId()
 * @method int|null getPriority()
 * @method string|null getSecretData()
 * @method bool|null getTemporary()
 * @method string|null getType()
 * @method string|null getUserLabel()
 * @method string|null getValue()
 * @method string|null getDevice()
 * @method string|null getSalt()
 * @method int|null getHashIterations()
 * @method string|null getAlgorithm()
 * @method int|null getCounter()
 * @method int|null getDigits()
 * @method int|null getPeriod()
 * @method self withCreatedDate(?int $createdDate)
 * @method self withCredentialData(?string $credentialData)
 * @method self withId(?string $id)
 * @method self withPriority(?int $priority)
 * @method self withSecretData(?string $secretData)
 * @method self withTemporary(?bool $temporary)
 * @method self withType(?string $type)
 * @method self withUserLabel(?string $userLabel)
 * @method self withValue(?string $value)
 * @method self withDevice(?string $device)
 * @method self withSalt(?string $salt)
 * @method self withHashIterations(?int $value)
 * @method self withAlgorithm(?string $value)
 * @method self withCounter(?string $counter)
 * @method self withDigits(?string $digits)
 * @method self withPeriod(?string $period)
 *
 * @codeCoverageIgnore
 */
class Credential extends Representation
{
    public function __construct(
        protected ?string $id = null,
        protected ?string $type = null,
        protected ?string $userLabel = null,
        protected ?int $createdDate = null,
        protected ?string $secretData = null,
        protected ?string $credentialData = null,
        protected ?int $priority = null,
        protected ?string $value = null,
        protected ?bool $temporary = null,
        protected ?string $device = null,
        protected ?string $hashedSaltedValue = null,
        protected ?string $salt = null,
        protected ?int $hashIterations = null,
        protected ?int $counter = null,
        protected ?string $algorithm = null,
        protected ?int $digits = null,
        protected ?int $period = null,
        protected ?Map $config = null,
    ) {}
}
