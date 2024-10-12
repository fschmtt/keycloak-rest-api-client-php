<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

/**
 * @codeCoverageIgnore
 */
class SystemInfo extends Representation
{
    public function __construct(
        protected ?string $fileEncoding = null,
        protected ?string $javaHome = null,
        protected ?string $javaRuntime = null,
        protected ?string $javaVendor = null,
        protected ?string $javaVersion = null,
        protected ?string $javaVm = null,
        protected ?string $javaVmVersion = null,
        protected ?string $osArchitecture = null,
        protected ?string $osName = null,
        protected ?string $osVersion = null,
        protected ?string $serverTime = null,
        protected ?string $uptime = null,
        protected ?int $uptimeMillis = null,
        protected ?string $userDir = null,
        protected ?string $userLocale = null,
        protected ?string $userName = null,
        protected ?string $userTimezone = null,
        protected ?string $version = null,
    ) {}


    public function getUserLocale(): string
    {
        return $this->userLocale;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserTimezone(): string
    {
        return $this->userTimezone;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return string|null
     */
    public function getFileEncoding(): ?string
    {
        return $this->fileEncoding;
    }

    /**
     * @return string|null
     */
    public function getJavaHome(): ?string
    {
        return $this->javaHome;
    }

    /**
     * @return string|null
     */
    public function getJavaRuntime(): ?string
    {
        return $this->javaRuntime;
    }

    /**
     * @return string|null
     */
    public function getJavaVendor(): ?string
    {
        return $this->javaVendor;
    }

    /**
     * @return string|null
     */
    public function getJavaVersion(): ?string
    {
        return $this->javaVersion;
    }

    /**
     * @return string|null
     */
    public function getJavaVm(): ?string
    {
        return $this->javaVm;
    }

    /**
     * @return string|null
     */
    public function getJavaVmVersion(): ?string
    {
        return $this->javaVmVersion;
    }

    /**
     * @return string|null
     */
    public function getOsArchitecture(): ?string
    {
        return $this->osArchitecture;
    }

    /**
     * @return string|null
     */
    public function getOsName(): ?string
    {
        return $this->osName;
    }

    /**
     * @return string|null
     */
    public function getOsVersion(): ?string
    {
        return $this->osVersion;
    }

    /**
     * @return string|null
     */
    public function getServerTime(): ?string
    {
        return $this->serverTime;
    }

    /**
     * @return string|null
     */
    public function getUptime(): ?string
    {
        return $this->uptime;
    }

    /**
     * @return int|null
     */
    public function getUptimeMillis(): ?int
    {
        return $this->uptimeMillis;
    }

    /**
     * @return string|null
     */
    public function getUserDir(): ?string
    {
        return $this->userDir;
    }
}
