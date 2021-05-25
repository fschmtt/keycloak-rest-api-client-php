<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Representation;

use Fschmtt\Keycloak\Exception\ReadOnlyException;

/**
 * @method int getFree()
 * @method string getFreeFormated()
 * @method int getFreePercentage()
 * @method int getTotal()
 * @method string getTotalFormated()
 * @method int getUsed()
 * @method string getUsedFormated()
 */
class MemoryInfo extends Representation
{
    protected int $free;

    protected string $freeFormated;

    protected int $freePercentage;

    protected int $total;

    protected string $totalFormated;

    protected int $used;

    protected string $usedFormated;

    /**
     * @throws ReadOnlyException
     */
    public function with(string $property, mixed $value): static
    {
        throw new ReadOnlyException(
            sprintf('Representation %s is read-only', self::class)
        );
    }
}
