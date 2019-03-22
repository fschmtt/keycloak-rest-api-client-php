<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class SystemInfo
{
    /**
     * @var string
     */
    private $fileEncoding;

    /**
     * @var string
     */
    private $javaHome;

    /**
     * @var string
     */
    private $javaRuntime;

    /**
     * @var string
     */
    private $javaVendor;

    /**
     * @var string
     */
    private $javaVersion;

    /**
     * @var string
     */
    private $javaVm;

    /**
     * @var string
     */
    private $javaVmVersion;

    /**
     * @var string
     */
    private $osArchitecture;

    /**
     * @var string
     */
    private $osName;

    /**
     * @var string
     */
    private $osVersion;

    /**
     * @var string
     */
    private $serverTime;

    /**
     * @var string
     */
    private $uptime;

    /**
     * @var int
     */
    private $uptimeMillis;

    /**
     * @var string
     */
    private $userDir;

    /**
     * @var string
     */
    private $userLocale;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $userTimezone;

    /**
     * @var string
     */
    private $version;

    public function __construct(
        string $fileEncoding,
        string $javaHome,
        string $javaRuntime,
        string $javaVendor,
        string $javaVersion,
        string $javaVm,
        string $javaVmVersion,
        string $osArchitecture,
        string $osName,
        string $osVersion,
        string $serverTime,
        string $uptime,
        int $uptimeMillis,
        string $userDir,
        string $userLocale,
        string $userName,
        string $userTimezone,
        string $version
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

    public function getFileEncoding(): string
    {
        return $this->fileEncoding;
    }

    public function getJavaHome(): string
    {
        return $this->javaHome;
    }

    public function getJavaRuntime(): string
    {
        return $this->javaRuntime;
    }

    public function getJavaVendor(): string
    {
        return $this->javaVendor;
    }

    public function getJavaVersion(): string
    {
        return $this->javaVersion;
    }

    public function getJavaVm(): string
    {
        return $this->javaVm;
    }

    public function getJavaVmVersion(): string
    {
        return $this->javaVmVersion;
    }

    public function getOsArchitecture(): string
    {
        return $this->osArchitecture;
    }

    public function getOsName(): string
    {
        return $this->osName;
    }

    public function getOsVersion(): string
    {
        return $this->osVersion;
    }

    public function getServerTime(): string
    {
        return $this->serverTime;
    }

    public function getUptime(): string
    {
        return $this->uptime;
    }

    public function getUptimeMillis(): int
    {
        return $this->uptimeMillis;
    }

    public function getUserDir(): string
    {
        return $this->userDir;
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
}
