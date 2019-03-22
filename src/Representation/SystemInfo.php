<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class SystemInfo
{
    /**
     * @var string|null
     */
    private $fileEncoding;

    /**
     * @var string|null
     */
    private $javaHome;

    /**
     * @var string|null
     */
    private $javaRuntime;

    /**
     * @var string|null
     */
    private $javaVendor;

    /**
     * @var string|null
     */
    private $javaVersion;

    /**
     * @var string|null
     */
    private $javaVm;

    /**
     * @var string|null
     */
    private $javaVmVersion;

    /**
     * @var string|null
     */
    private $osArchitecture;

    /**
     * @var string|null
     */
    private $osName;

    /**
     * @var string|null
     */
    private $osVersion;

    /**
     * @var string|null
     */
    private $serverTime;

    /**
     * @var string|null
     */
    private $uptime;

    /**
     * @var int|null
     */
    private $uptimeMillis;

    /**
     * @var string|null
     */
    private $userDir;

    /**
     * @var string|null
     */
    private $userLocale;

    /**
     * @var string|null
     */
    private $userName;

    /**
     * @var string|null
     */
    private $userTimezone;

    /**
     * @var string|null
     */
    private $version;

    /**
     * @param string|null $fileEncoding
     * @param string|null $javaHome
     * @param string|null $javaRuntime
     * @param string|null $javaVendor
     * @param string|null $javaVersion
     * @param string|null $javaVm
     * @param string|null $javaVmVersion
     * @param string|null $osArchitecture
     * @param string|null $osName
     * @param string|null $osVersion
     * @param string|null $serverTime
     * @param string|null $uptime
     * @param int|null $uptimeMillis
     * @param string|null $userDir
     * @param string|null $userLocale
     * @param string|null $userName
     * @param string|null $userTimezone
     * @param string|null $version
     */
    public function __construct(
        ?string $fileEncoding,
        ?string $javaHome,
        ?string $javaRuntime,
        ?string $javaVendor,
        ?string $javaVersion,
        ?string $javaVm,
        ?string $javaVmVersion,
        ?string $osArchitecture,
        ?string $osName,
        ?string $osVersion,
        ?string $serverTime,
        ?string $uptime,
        ?int $uptimeMillis,
        ?string $userDir,
        ?string $userLocale,
        ?string $userName,
        ?string $userTimezone,
        ?string $version
    ) {
        $this->fileEncoding = $fileEncoding;
        $this->javaHome = $javaHome;
        $this->javaRuntime = $javaRuntime;
        $this->javaVendor = $javaVendor;
        $this->javaVersion = $javaVersion;
        $this->javaVm = $javaVm;
        $this->javaVmVersion = $javaVmVersion;
        $this->osArchitecture = $osArchitecture;
        $this->osName = $osName;
        $this->osVersion = $osVersion;
        $this->serverTime = $serverTime;
        $this->uptime = $uptime;
        $this->uptimeMillis = $uptimeMillis;
        $this->userDir = $userDir;
        $this->userLocale = $userLocale;
        $this->userName = $userName;
        $this->userTimezone = $userTimezone;
        $this->version = $version;
    }
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
