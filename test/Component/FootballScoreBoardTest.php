<?php

declare(strict_types=1);

namespace WorldCup\Component\Test;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use WorldCup\Component\DisplayHandler;
use WorldCup\Component\FootballScoreBoard;
use WorldCup\Model\Collection\FootballMatchCollection;
use WorldCup\Model\Data\FootballMatch;
use WorldCup\Model\Enum\Team;
use WorldCup\Model\ValueObject\Score;

class FootballScoreBoardTest extends TestCase
{
    private DisplayHandler|MockObject $displayHandlerMock;
    private FootballScoreBoard $footballScoreBoard;

    public function setUp(): void
    {
        $this->displayHandlerMock = $this->createMock(DisplayHandler::class);
        $this->footballScoreBoard = new FootballScoreBoard(
            $this->displayHandlerMock,
        );
    }

    public function tearDown(): void
    {
        unset(
            $this->displayHandlerMock,
            $this->footballScoreBoard,
        );
    }
    public function testStartGame(): void
    {
        $footballMatch = new FootballMatch(Team::Argentina, Team::Mexico);

        $this->displayHandlerMock
            ->expects($this->once())
            ->method('startGame')
            ->with($footballMatch);

        $this->footballScoreBoard->startGame($footballMatch);

        $this->assertTrue($this->footballScoreBoard->getMatches()->contains($footballMatch));
    }

    public function testFinishGame(): void
    {
        $footballMatch = new FootballMatch(Team::Argentina, Team::Mexico);
        $this->footballScoreBoard->startGame($footballMatch);
        $this->displayHandlerMock
            ->expects($this->once())
            ->method('finishGame')
            ->with($footballMatch);
        $this->footballScoreBoard->finishGame($footballMatch);

        $this->assertFalse($this->footballScoreBoard->getMatches()->contains($footballMatch));
    }

    public function testUpdateScore(): void
    {
        $footballMatch = new FootballMatch(Team::Argentina, Team::Mexico);
        $this->footballScoreBoard->startGame($footballMatch);

        $this->displayHandlerMock
            ->expects($this->once())
            ->method('updateScore')
            ->with($footballMatch);

        $this->footballScoreBoard->updateScore($footballMatch, new Score(2), new Score(1));

        $this->assertEquals(2, $footballMatch->getHomeScore()->getValue());
        $this->assertEquals(1, $footballMatch->getAwayScore()->getValue());
    }

    public function testPrintSummaryTable(): void
    {
        $footballMatch1 = new FootballMatch(Team::Argentina, Team::Mexico, new Score(0), new Score(0));
        $footballMatch2 = new FootballMatch(Team::Brazil, Team::Germany, new Score(2), new Score(2));
        $footballMatchCollection = new FootballMatchCollection($footballMatch1, $footballMatch2);

        $this->footballScoreBoard->startGame($footballMatch1);
        $this->footballScoreBoard->startGame($footballMatch2);

        $this->displayHandlerMock
            ->expects($this->once())
            ->method('printSummaryTable')
            ->with($this->equalTo($footballMatchCollection));

        $this->footballScoreBoard->printSummaryTable();
    }

    public function testGetMatches(): void
    {
        $footballMatch1 = new FootballMatch(Team::Argentina, Team::Mexico);
        $footballMatch2 = new FootballMatch(Team::Brazil, Team::Germany);

        $this->footballScoreBoard->startGame($footballMatch1);
        $this->footballScoreBoard->startGame($footballMatch2);

        $matches = $this->footballScoreBoard->getMatches();

        $this->assertInstanceOf(FootballMatchCollection::class, $matches);
        $this->assertTrue($matches->contains($footballMatch1));
        $this->assertTrue($matches->contains($footballMatch2));
    }

    public function testSort(): void
    {
        $footballMatch1 = new FootballMatch(
            Team::Argentina,
            Team::Mexico,
            new Score(0),
            new Score(0),
            new \DateTimeImmutable('2024-01-20'),
        );
        $footballMatch2 = new FootballMatch(
            Team::Brazil,
            Team::Germany,
            new Score(2),
            new Score(2),
            new \DateTimeImmutable('2024-01-18'),
        );
        $footballMatch3 = new FootballMatch(
            Team::Italy,
            Team::France,
            new Score(2),
            new Score(2),
            new \DateTimeImmutable('2024-01-19'),
        );
        $footballMatch4 = new FootballMatch(
            Team::Australia,
            Team::Canada,
            new Score(6),
            new Score(6),
            new \DateTimeImmutable('2024-01-19'),
        );

        $this->footballScoreBoard->startGame($footballMatch1);
        $this->footballScoreBoard->startGame($footballMatch2);
        $this->footballScoreBoard->startGame($footballMatch3);
        $this->footballScoreBoard->startGame($footballMatch4);

        $sortedMatchesArray = [
            $footballMatch4->getMatchTitle()->getValue() => $footballMatch4,
            $footballMatch2->getMatchTitle()->getValue() => $footballMatch2,
            $footballMatch3->getMatchTitle()->getValue() => $footballMatch3,
            $footballMatch1->getMatchTitle()->getValue() => $footballMatch1,
        ];

        $sortedCollection = $this->footballScoreBoard->sort();
        $actualMatchesArray = $sortedCollection->getArrayCopy();

        $this->assertSame($sortedMatchesArray, $actualMatchesArray);
    }
}