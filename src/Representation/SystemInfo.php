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

    public function getUserLocale(): ?string
    {
        return $this->userLocale;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function getUserTimezone(): ?string
    {
        return $this->userTimezone;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function getFileEncoding(): ?string
    {
        return $this->fileEncoding;
    }

    public function getJavaHome(): ?string
    {
        return $this->javaHome;
    }

    public function getJavaRuntime(): ?string
    {
        return $this->javaRuntime;
    }

    public function getJavaVendor(): ?string
    {
        return $this->javaVendor;
    }

    public function getJavaVersion(): ?string
    {
        return $this->javaVersion;
    }

    public function getJavaVm(): ?string
    {
        return $this->javaVm;
    }

    public function getJavaVmVersion(): ?string
    {
        return $this->javaVmVersion;
    }

    public function getOsArchitecture(): ?string
    {
        return $this->osArchitecture;
    }

    public function getOsName(): ?string
    {
        return $this->osName;
    }

    public function getOsVersion(): ?string
    {
        return $this->osVersion;
    }

    public function getServerTime(): ?string
    {
        return $this->serverTime;
    }

    public function getUptime(): ?string
    {
        return $this->uptime;
    }

    public function getUptimeMillis(): ?int
    {
        return $this->uptimeMillis;
    }

    public function getUserDir(): ?string
    {
        return $this->userDir;
    }
}
