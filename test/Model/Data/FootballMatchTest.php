<?php

declare(strict_types=1);

namespace WorldCup\Model\Test;

use PHPUnit\Framework\TestCase;
use WorldCup\Model\Data\FootballMatch;
use WorldCup\Model\Enum\Team;
use WorldCup\Model\ValueObject\MatchTitle;
use WorldCup\Model\ValueObject\Score;

class FootballMatchTest extends TestCase
{
    public function constructDataProvider(): \Traversable
    {
        $startTime = new \DateTimeImmutable('2022-02-02');
        $homeTeam = Team::Argentina;
        $awayTeam = Team::Mexico;
        $homeScore = new Score(2);
        $awayScore = new Score(3);
        $expectedMatchTitle = new MatchTitle('Argentina' . 'Mexico');

        $default = [
            'startTime' => $startTime,
            'homeTeam' => $homeTeam,
            'awayTeam' => $awayTeam,
            'homeScore' => $homeScore,
            'awayScore' => $awayScore,
            'expectedMatchTitle' => $expectedMatchTitle,
            'expectedException' => null,
        ];

        yield 'normal case' => $default;

        yield 'invalid startTime' => \array_replace($default, [
            'startTime' => '2022-02-02',
            'expectedException' => \TypeError::class,
        ]);
        yield 'invalid homeTeam' => \array_replace($default, [
            'homeTeam' => 'Argentina',
            'expectedException' => \TypeError::class,
        ]);
        yield 'invalid awayTeam' => \array_replace($default, [
            'awayTeam' => 'Argentina',
            'expectedException' => \TypeError::class,
        ]);
        yield 'invalid homeScore' => \array_replace($default, [
            'homeScore' => 0,
            'expectedException' => \TypeError::class,
        ]);
        yield 'invalid awayScore' => \array_replace($default, [
            'awayScore' => 1,
            'expectedException' => \TypeError::class,
        ]);
    }

    /**
     * @dataProvider constructDataProvider
     */
    public function testGetStartTime(
        $startTime,
        $homeTeam,
        $awayTeam,
        $homeScore,
        $awayScore,
        $expectedMatchTitle,
        $expectedException,
    ): void {
        if (!\is_null($expectedException)) {
            $this->expectException($expectedException);
        }

        $footballMatch = new FootballMatch(
            $homeTeam,
            $awayTeam,
            $homeScore,
            $awayScore,
            $startTime,
        );

        $this->assertEquals($startTime, $footballMatch->getStartTime());
        $this->assertEquals($homeTeam, $footballMatch->getHomeTeam());
        $this->assertEquals($awayTeam, $footballMatch->getAwayTeam());
        $this->assertEquals($homeScore, $footballMatch->getHomeScore());
        $this->assertEquals($awayScore, $footballMatch->getAwayScore());
        $this->assertEquals($expectedMatchTitle, $footballMatch->getMatchTitle());
    }
}
