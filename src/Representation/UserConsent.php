<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class UserConsent
{
    /**
     * @var string|null
     */
    private $clientId;

    /**
     * @var int|null
     */
    private $createdDate;

    /**
     * @var string[]|null
     */
    private $grantedClientSCopes;

    /**
     * @var int|null
     */
    private $lastUpdatedDate;

    /**
     * @param string|null $clientId
     * @param int|null $createdDate
     * @param string[]|null $grantedClientSCopes
     * @param int|null $lastUpdatedDate
     */
    public function __construct(
        ?string $clientId,
        ?int $createdDate,
        ?array $grantedClientSCopes,
        ?int $lastUpdatedDate
    ) {
        $this->clientId = $clientId;
        $this->createdDate = $createdDate;
        $this->grantedClientSCopes = $grantedClientSCopes;
        $this->lastUpdatedDate = $lastUpdatedDate;
    }

    /**
     * @return string|null
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @return int|null
     */
    public function getCreatedDate(): ?int
    {
        return $this->createdDate;
    }

    /**
     * @return string[]|null
     */
    public function getGrantedClientSCopes(): ?array
    {
        return $this->grantedClientSCopes;
    }

    /**
     * @return int|null
     */
    public function getLastUpdatedDate(): ?int
    {
        return $this->lastUpdatedDate;
    }
}
