<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class FederatedIdentity
{
    /**
     * @var string|null
     */
    private $identityProvider;

    /**
     * @var string|null
     */
    private $userId;

    /**
     * @var string|null
     */
    private $userName;

    /**
     * @param string|null $identityProvider
     * @param string|null $userId
     * @param string|null $userName
     */
    public function __construct(
        ?string $identityProvider,
        ?string $userId,
        ?string $userName
    ) {
        $this->identityProvider = $identityProvider;
        $this->userId = $userId;
        $this->userName = $userName;
    }

    /**
     * @return string|null
     */
    public function getIdentityProvider(): ?string
    {
        return $this->identityProvider;
    }

    /**
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }
}
