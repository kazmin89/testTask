<?php

declare(strict_types=1);

namespace WorldCup\Component;

use WorldCup\Model\Collection\FootballMatchCollection;
use WorldCup\Model\Data\FootballMatch;

class DisplayHandler
{
    public function startGame(FootballMatch $footballMatch): void
    {
        echo 'Game started: ' .
            $footballMatch->getHomeTeam()->value .
            ' 0-0 ' .
            $footballMatch->getAwayTeam()->value .
            PHP_EOL;
    }

    public function finishGame(FootballMatch $footballMatch): void
    {
        echo 'Game finished: ' .
            $footballMatch->getHomeTeam()->value . ' ' .
            $footballMatch->getHomeScore()->getValue() .
            '-' .
            $footballMatch->getAwayScore()->getValue() . ' ' .
            $footballMatch->getAwayTeam()->value .
            PHP_EOL;
    }

    public function updateScore(FootballMatch $footballMatch): void
    {
        echo 'Score updated: ' .
            $footballMatch->getHomeTeam()->value . ' ' .
            $footballMatch->getHomeScore()->getValue() .
            '-' .
            $footballMatch->getAwayScore()->getValue() . ' ' .
            $footballMatch->getAwayTeam()->value .
            PHP_EOL;
    }

    public function printSummaryTable(FootballMatchCollection $footballMatchCollection): void
    {
        echo PHP_EOL . 'Summary table' . PHP_EOL;
        $i = 0;
        foreach ($footballMatchCollection as $footballMatch) {
            echo ++$i . '. ' .
                $footballMatch->getHomeTeam()->value . ' ' .
                $footballMatch->getHomeScore()->getValue() .
                '-' .
                $footballMatch->getAwayScore()->getValue() . ' ' .
                $footballMatch->getAwayTeam()->value . ' ' .
                PHP_EOL;
        }

        echo PHP_EOL;
    }
}