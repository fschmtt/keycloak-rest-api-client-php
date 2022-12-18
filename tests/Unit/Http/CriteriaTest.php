<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Http;

use Fschmtt\Keycloak\Http\Criteria;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Fschmtt\Keycloak\Http\Criteria
 */
class CriteriaTest extends TestCase
{
    public function testCanCreateEmptyCriteria(): void
    {
        $criteria = new Criteria();

        static::assertSame([], $criteria->jsonSerialize());
    }

    public function testCanCreateCriteriaWithBoolCriterion(): void
    {
        $criteria = new Criteria([
            Criteria::BRIEF_REPRESENTATION => true,
        ]);

        static::assertArrayHasKey(Criteria::BRIEF_REPRESENTATION, $criteria->jsonSerialize());
        static::assertSame('true', $criteria->jsonSerialize()[Criteria::BRIEF_REPRESENTATION]);
    }

    public function testCanCreateCriteriaWithArrayCriterion(): void
    {
        $criteria = new Criteria([
            Criteria::ADMIN_EVENT_OPERATION_TYPES => ['type-a', 'type-b'],
        ]);

        static::assertArrayHasKey(Criteria::ADMIN_EVENT_OPERATION_TYPES, $criteria->jsonSerialize());
        static::assertSame(['type-a', 'type-b'], $criteria->jsonSerialize()[Criteria::ADMIN_EVENT_OPERATION_TYPES]);
    }
}
