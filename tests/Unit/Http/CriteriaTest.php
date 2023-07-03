<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use DateTimeImmutable;
use Fschmtt\Keycloak\Http\Criteria;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Stringable;

#[CoversClass(Criteria::class)]
class CriteriaTest extends TestCase
{
    public function testCanCreateEmptyCriteria(): void
    {
        $criteria = new Criteria();

        static::assertSame([], $criteria->jsonSerialize());
    }

    public function testFiltersOutNullCriterion(): void
    {
        $criteria = new Criteria([
            'foo' => null,
        ]);

        static::assertSame([], $criteria->jsonSerialize());
    }

    public function testCanCreateCriteriaWithBoolCriterion(): void
    {
        $criteria = new Criteria([
            'bool' => true,
        ]);

        static::assertArrayHasKey('bool', $criteria->jsonSerialize());
        static::assertSame('true', $criteria->jsonSerialize()['bool']);
    }

    public function testCanCreateCriteriaWithArrayCriterion(): void
    {
        $criteria = new Criteria([
            'array' => ['type-a', 'type-b'],
        ]);

        static::assertArrayHasKey('array', $criteria->jsonSerialize());
        static::assertSame(['type-a', 'type-b'], $criteria->jsonSerialize()['array']);
    }

    public function testCanCreateCriteriaWithDateTimeImmutableCriterion(): void
    {
        $criteria = new Criteria([
            'dateTimeImmutable' => new DateTimeImmutable('2022-12-18'),
        ]);

        static::assertArrayHasKey('dateTimeImmutable', $criteria->jsonSerialize());
        static::assertSame('2022-12-18', $criteria->jsonSerialize()['dateTimeImmutable']);
    }

    public function testCanCreateCriteriaWithStringableCriterion(): void
    {
        $criteria = new Criteria([
            'stringable' => new class() implements Stringable {
                public function __toString(): string
                {
                    return 'criterion';
                }
            },
        ]);

        static::assertArrayHasKey('stringable', $criteria->jsonSerialize());
        static::assertSame('criterion', $criteria->jsonSerialize()['stringable']);
    }
}
