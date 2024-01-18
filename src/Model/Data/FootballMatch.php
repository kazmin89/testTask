<?php

declare(strict_types=1);

namespace WorldCup\Model\Data;

use WorldCup\Model\Enum\Team;
use WorldCup\Model\ValueObject\MatchTitle;
use WorldCup\Model\ValueObject\Score;

class FootballMatch
{
    private Team $homeTeam;
    private Team $awayTeam;
    private Score $homeScore;
    private Score $awayScore;
    private MatchTitle $matchTitle;
    private \DateTimeImmutable $startTime;

    public function __construct(
        Team $homeTeam,
        Team $awayTeam,
        Score $homeScore = new Score(0),
        Score $awayScore = new Score(0),
        \DateTimeImmutable $startTime = new \DateTimeImmutable(),
    ) {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->homeScore = $homeScore;
        $this->awayScore = $awayScore;
        $this->matchTitle = new MatchTitle($this->homeTeam->value . $this->awayTeam->value);
        $this->startTime = $startTime;
    }

    public function getStartTime(): \DateTimeImmutable
    {
        return $this->startTime;
    }

    public function getMatchTitle(): MatchTitle
    {
        return $this->matchTitle;
    }

    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }

    public function getHomeScore(): Score
    {
        return $this->homeScore;
    }

    public function getAwayScore(): Score
    {
        return $this->awayScore;
    }

    public function setHomeScore(Score $homeScore): self
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    public function setAwayScore(Score $awayScore): self
    {
        $this->awayScore = $awayScore;

        return $this;
    }
}