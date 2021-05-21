<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

class MemoryInfo extends Representation
{
    protected int $free;

    protected string $freeFormated;

    protected int $total;

    protected string $totalFormated;

    protected int $used;

    protected string $usedFormated;

    public function getFree(): int
    {
        return $this->free;
    }

    public function getFreeFormatted(): string
    {
        return $this->freeFormated;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getTotalFormatted(): string
    {
        return $this->totalFormated;
    }

    public function getUsed(): int
    {
        return $this->used;
    }

    public function getUsedFormatted(): string
    {
        return $this->usedFormated;
    }
}
