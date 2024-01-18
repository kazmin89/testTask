<?php

declare(strict_types=1);

namespace WorldCup\Model\ValueObject\Test;

use PHPUnit\Framework\TestCase;
use WorldCup\Model\ValueObject\Score;

class ScoreTest extends TestCase
{
    public function testValidScore(): void
    {
        $scoreValue = 5;
        $score = new Score($scoreValue);

        $this->assertSame($scoreValue, $score->getValue());
    }

    public function testInvalidScore(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Score(-1);
    }
}
