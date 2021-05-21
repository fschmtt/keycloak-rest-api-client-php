<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class Credential
{
    /**
     * @var string|null
     */
    private $algorithm;

    /**
     * @var array|null
     * TODO MultivaluedHashMap
     */
    private $config;

    /**
     * @var int|null
     */
    private $counter;

    /**
     * @var int|null
     */
    private $createdDate;

    /**
     * @var string|null
     */
    private $device;

    /**
     * @var int|null
     */
    private $digits;

    /**
     * @var int|null
     */
    private $hashIterations;

    /**
     * @var string|null
     */
    private $hashedSaltedValue;

    /**
     * @var int|null
     */
    private $period;

    /**
     * @var string|null
     */
    private $salt;

    /**
     * @var bool|null
     */
    private $temporary;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $value;

    /**
     * @param string|null $algorithm
     * @param array|null $config
     * @param int|null $counter
     * @param int|null $createdDate
     * @param string|null $device
     * @param int|null $digits
     * @param int|null $hashIterations
     * @param string|null $hashedSaltedValue
     * @param int|null $period
     * @param string|null $salt
     * @param bool|null $temporary
     * @param string|null $type
     * @param string|null $value
     */
    public function __construct(
        ?string $algorithm,
        ?array $config,
        ?int $counter,
        ?int $createdDate,
        ?string $device,
        ?int $digits,
        ?int $hashIterations,
        ?string $hashedSaltedValue,
        ?int $period,
        ?string $salt,
        ?bool $temporary,
        ?string $type,
        ?string $value
    ) {
        $this->algorithm = $algorithm;
        $this->config = $config;
        $this->counter = $counter;
        $this->createdDate = $createdDate;
        $this->device = $device;
        $this->digits = $digits;
        $this->hashIterations = $hashIterations;
        $this->hashedSaltedValue = $hashedSaltedValue;
        $this->period = $period;
        $this->salt = $salt;
        $this->temporary = $temporary;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return string|null
     */
    public function getAlgorithm(): ?string
    {
        return $this->algorithm;
    }

    /**
     * @return array|null
     */
    public function getConfig(): ?array
    {
        return $this->config;
    }

    /**
     * @return int|null
     */
    public function getCounter(): ?int
    {
        return $this->counter;
    }

    /**
     * @return int|null
     */
    public function getCreatedDate(): ?int
    {
        return $this->createdDate;
    }

    /**
     * @return string|null
     */
    public function getDevice(): ?string
    {
        return $this->device;
    }

    /**
     * @return int|null
     */
    public function getDigits(): ?int
    {
        return $this->digits;
    }

    /**
     * @return int|null
     */
    public function getHashIterations(): ?int
    {
        return $this->hashIterations;
    }

    /**
     * @return string|null
     */
    public function getHashedSaltedValue(): ?string
    {
        return $this->hashedSaltedValue;
    }

    /**
     * @return int|null
     */
    public function getPeriod(): ?int
    {
        return $this->period;
    }

    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return $this->salt;
    }

    /**
     * @return bool|null
     */
    public function getTemporary(): ?bool
    {
        return $this->temporary;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}
