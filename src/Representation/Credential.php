<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Type\Map;

/**
 * @method int|null getCreatedDate()
 * @method self withCreatedDate(?int $createdDate)
 *
 * @method string|null getCredentialData()
 * @method self withCredentialData(?string $credentialData)
 *
 * @method string|null getId()
 * @method self withId(?string $id)
 *
 * @method int|null getPriority()
 * @method self withPriority(?int $priority)
 *
 * @method string|null getSecretData()
 * @method self withSecretData(?string $secretData)
 *
 * @method bool|null getTemporary()
 * @method self withTemporary(?bool $temporary)
 *
 * @method string|null getType()
 * @method self withType(?string $type)
 *
 * @method string|null getUserLabel()
 * @method self withUserLabel(?string $userLabel)
 *
 * @method string|null getValue()
 * @method self withValue(?string $value)
 *
 * @method string|null getDevice()
 * @method self withDevice(?string $device)
 *
 * @method string|null getSalt()
 * @method self withSalt(?string $salt)
 *
 * @method int|null getHashIterations()
 * @method self withHashIterations(?int $value)
 *
 * @method string|null getAlgorithm()
 * @method self withAlgorithm(?string $value)
 *
 * @method int|null getCounter()
 * @method self withCounter(?string $counter)
 *
 * @method int|null getDigits()
 * @method self withDigits(?string $digits)
 *
 * @method int|null getPeriod()
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
