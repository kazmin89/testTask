<?php

declare(strict_types=1);

namespace WorldCup\Component;

use WorldCup\Model\Collection\FootballMatchCollection;
use WorldCup\Model\Data\FootballMatch;

class FootballScoreBoard
{
    private FootballMatchCollection $matches;

    public function __construct(private DisplayHandler $displayHandler)
    {
        $this->matches = new FootballMatchCollection();
    }

    public function startGame(FootballMatch $match): void
    {
        $this->matches->addItem($match);
        $this->displayHandler->startGame($match);
    }

    public function finishGame(FootballMatch $match): void
    {
        $this->matches->deleteItem($match);
        $this->displayHandler->finishGame($match);
    }

    public function updateScore(FootballMatch $match, $homeScore, $awayScore)
    {
        if (!$this->matches->contains($match)) {
            throw new \LogicException('Match does not exist');
        }
        $match->setHomeScore($homeScore)->setAwayScore($awayScore);
        $this->matches->addItem($match);
        $this->displayHandler->updateScore($match);
    }

    public function printSummaryTable(): void
    {
        $collection = $this->sort();
        $this->displayHandler->printSummaryTable($collection);
    }

    public function getMatches(): FootballMatchCollection
    {
        return $this->matches;
    }

    public function sort(): FootballMatchCollection
    {
        $matchesArray = $this->matches->getArrayCopy();
        \usort(
            $matchesArray,
            function (FootballMatch $match1, FootballMatch $match2) {
                $scoreSum1 = $match1->getAwayScore()->getValue() + $match1->getHomeScore()->getValue();
                $scoreSum2 = $match2->getAwayScore()->getValue() + $match2->getHomeScore()->getValue();

                if ($scoreSum1 == $scoreSum2) {
                    return $match1->getStartTime()->getTimestamp() <=> $match2->getStartTime()->getTimestamp();
                }

                return $scoreSum2 <=> $scoreSum1;
            }
        );

        return new FootballMatchCollection(...$matchesArray);
    }
}