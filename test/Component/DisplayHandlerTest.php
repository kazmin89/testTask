<?php

declare(strict_types=1);

namespace WorldCup\Component\Test;

use PHPUnit\Framework\TestCase;
use WorldCup\Component\DisplayHandler;
use WorldCup\Model\Collection\FootballMatchCollection;
use WorldCup\Model\Data\FootballMatch;
use WorldCup\Model\Enum\Team;
use WorldCup\Model\ValueObject\Score;

class DisplayHandlerTest extends TestCase
{
    public function testStartGame(): void
    {
        $displayHandler = new DisplayHandler();
        $homeTeam = Team::Argentina;
        $awayTeam = Team::Mexico;
        $footballMatch = new FootballMatch($homeTeam, $awayTeam);

        $this->expectOutputString('Game started: Argentina 0-0 Mexico' . PHP_EOL);

        $displayHandler->startGame($footballMatch);
    }

    public function testFinishGame(): void
    {
        $displayHandler = new DisplayHandler();
        $homeTeam = Team::Argentina;
        $awayTeam = Team::Mexico;
        $footballMatch = new FootballMatch($homeTeam, $awayTeam);
        $footballMatch->setHomeScore(new Score(3));
        $footballMatch->setAwayScore(new Score(1));

        $this->expectOutputString('Game finished: Argentina 3-1 Mexico' . PHP_EOL);

        $displayHandler->finishGame($footballMatch);
    }

    public function testUpdateScore(): void
    {
        $displayHandler = new DisplayHandler();
        $homeTeam = Team::Argentina;
        $awayTeam = Team::Mexico;
        $footballMatch = new FootballMatch($homeTeam, $awayTeam);
        $footballMatch->setHomeScore(new Score(1));
        $footballMatch->setAwayScore(new Score(2));

        $this->expectOutputString('Score updated: Argentina 1-2 Mexico' . PHP_EOL);

        $displayHandler->updateScore($footballMatch);
    }

    public function testPrintSummaryTable(): void
    {
        $displayHandler = new DisplayHandler();
        $footballMatchCollection = new FootballMatchCollection(
            new FootballMatch(Team::Mexico, Team::Spain, new Score(0), new Score(0)),
            new FootballMatch(Team::Argentina, Team::Canada, new Score(3), new Score(3)),
            new FootballMatch(Team::Germany, Team::Uruguay, new Score(2), new Score(1)),
        );

        $this->expectOutputString(
            PHP_EOL . 'Summary table' . PHP_EOL .
            '1. Mexico 0-0 Spain ' . PHP_EOL .
            '2. Argentina 3-3 Canada ' . PHP_EOL .
            '3. Germany 2-1 Uruguay ' . PHP_EOL . PHP_EOL
        );

        $displayHandler->printSummaryTable($footballMatchCollection);
    }
}