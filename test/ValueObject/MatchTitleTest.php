<?php

declare(strict_types=1);

namespace WorldCup\Model\ValueObject\Test;

use PHPUnit\Framework\TestCase;
use WorldCup\Model\ValueObject\MatchTitle;

class MatchTitleTest extends TestCase
{
    public function testValidMatchTitle(): void
    {
        $matchTitleValue = 'ValidMatchTitle';
        $matchTitle = new MatchTitle($matchTitleValue);

        $this->assertSame($matchTitleValue, $matchTitle->getValue());
    }

    public function testInvalidMatchTitle(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new MatchTitle('');
    }
}