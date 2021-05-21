<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class SystemInfo extends Representation
{
    protected ?string $fileEncoding;

    protected ?string $javaHome;

    protected ?string $javaRuntime;

    protected ?string $javaVendor;

    protected ?string $javaVersion;

    protected ?string $javaVm;

    protected ?string $javaVmVersion;

    protected ?string $osArchitecture;

    protected ?string $osName;

    protected ?string $osVersion;

    protected ?string $serverTime;

    protected ?string $uptime;

    protected ?int $uptimeMillis;

    protected ?string $userDir;

    protected ?string $userLocale;

    protected ?string $userName;

    protected ?string $userTimezone;

    protected ?string $version;

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
