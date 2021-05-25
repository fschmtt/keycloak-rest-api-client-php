<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @method string|null getAlgorithm()
 * @method array|null getConfig()
 * @method int|null getCounter()
 * @method int|null getCreatedDate()
 * @method string|null getDevice()
 * @method int|null getDigits()
 * @method int|null getHashIterations()
 * @method string|null getHashedSaltedValue()
 * @method int|null getPeriod()
 * @method bool|null getTemporary()
 * @method string|null getType()
 * @method string|null getValue()
 * @method self withAlgorithm(?string $algorithm)
 * @method self withConfig(?string $config)
 * @method self withCounter(?int $config)
 * @method self withCreatedDate(?string $createdDate)
 * @method self withDevice(?string $device)
 * @method self withDigits(?int $digits)
 * @method self withHashIterations(?int $hashIterations)
 * @method self withHashedSaltedValue(?string $hashedSaltedValue)
 * @method self withPeriod(?int $period)
 * @method self withTemporary(?bool $temporary)
 * @method self withType(?string $type)
 * @method self withValue(?string $value)
 */
class Credential extends Representation
{
    public function __construct(
        protected ?string $algorithm = null,
        protected ?array $config = null,
        protected ?int $counter = null,
        protected ?int $createdDate = null,
        protected ?string $device = null,
        protected ?int $digits = null,
        protected ?int $hashIterations = null,
        protected ?string $hashedSaltedValue = null,
        protected ?int $period = null,
        protected ?string $salt = null,
        protected ?bool $temporary = null,
        protected ?string $type = null,
        protected ?string $value = null
    ) {
        parent::__construct(
            $algorithm,
            $config,
            $counter,
            $createdDate,
            $device,
            $digits,
            $hashIterations,
            $hashedSaltedValue,
            $period,
            $salt,
            $temporary,
            $type,
            $value,
        );
    }
}
