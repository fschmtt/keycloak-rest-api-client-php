<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class MemoryInfo
{
    /**
     * @var int
     */
    private $free;

    /**
     * @var string
     */
    private $freeFormatted;

    /**
     * @var int
     */
    private $total;

    /**
     * @var string
     */
    private $totalFormatted;

    /**
     * @var int
     */
    private $used;

    /**
     * @var string
     */
    private $usedFormatted;

    public function __construct(
        int $free,
        string $freeFormatted,
        int $total,
        string $totalFormatted,
        int $used,
        string $usedFormatted
    ) {
        $this->free = $free;
        $this->freeFormatted = $freeFormatted;
        $this->total = $total;
        $this->totalFormatted = $totalFormatted;
        $this->used = $used;
        $this->usedFormatted = $usedFormatted;
    }

    public function getFree(): int
    {
        return $this->free;
    }

    public function getFreeFormatted(): string
    {
        return $this->freeFormatted;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getTotalFormatted(): string
    {
        return $this->totalFormatted;
    }

    public function getUsed(): int
    {
        return $this->used;
    }

    public function getUsedFormatted(): string
    {
        return $this->usedFormatted;
    }
}
