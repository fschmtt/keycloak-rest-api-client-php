<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class UserFederationProvider
{
    /**
     * @var int|null
     */
    private $changedSyncPeriod;

    /**
     * @var array|null
     */
    private $config;

    /**
     * @var string|null
     */
    private $displayName;

    /**
     * @var int|null
     */
    private $fullSyncPeriod;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @var int|null
     */
    private $lastSync;

    /**
     * @var int|null
     */
    private $priority;

    /**
     * @var string|null
     */
    private $providerName;

    /**
     * @param int|null $changedSyncPeriod
     * @param array|null $config
     * @param string|null $displayName
     * @param int|null $fullSyncPeriod
     * @param string|null $id
     * @param int|null $lastSync
     * @param int|null $priority
     * @param string|null $providerName
     */
    public function __construct(
        ?int $changedSyncPeriod,
        ?array $config,
        ?string $displayName,
        ?int $fullSyncPeriod,
        ?string $id,
        ?int $lastSync,
        ?int $priority,
        ?string $providerName
    ) {
        $this->changedSyncPeriod = $changedSyncPeriod;
        $this->config = $config;
        $this->displayName = $displayName;
        $this->fullSyncPeriod = $fullSyncPeriod;
        $this->id = $id;
        $this->lastSync = $lastSync;
        $this->priority = $priority;
        $this->providerName = $providerName;
    }

    /**
     * @return int|null
     */
    public function getChangedSyncPeriod(): ?int
    {
        return $this->changedSyncPeriod;
    }

    /**
     * @return array|null
     */
    public function getConfig(): ?array
    {
        return $this->config;
    }

    /**
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @return int|null
     */
    public function getFullSyncPeriod(): ?int
    {
        return $this->fullSyncPeriod;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getLastSync(): ?int
    {
        return $this->lastSync;
    }

    /**
     * @return int|null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @return string|null
     */
    public function getProviderName(): ?string
    {
        return $this->providerName;
    }
}
