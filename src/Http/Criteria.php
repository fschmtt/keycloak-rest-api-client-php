<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Http;

use DateTimeInterface;
use Stringable;

class Criteria
{
    /**
     * @var array<string, mixed>
     */
    private array $criteria;

    /**
     * @param array<string, mixed> $criteria
     */
    public function __construct(array $criteria = [])
    {
        $this->criteria = $criteria;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $serialized = [];

        foreach ($this->criteria as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (is_bool($value)) {
                $serialized[$key] = $value ? 'true' : 'false';

                continue;
            }

            if ($value instanceof DateTimeInterface) {
                $serialized[$key] = $value->format('Y-m-d');

                continue;
            }

            if ($value instanceof Stringable) {
                $serialized[$key] = (string) $value;

                continue;
            }

            $serialized[$key] = $value;
        }

        return $serialized;
    }
}
