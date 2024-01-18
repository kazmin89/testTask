<?php

declare(strict_types=1);

use WorldCup\Component\DisplayHandler;
use WorldCup\Component\FootballScoreBoard;
use WorldCup\Model\Data\FootballMatch;
use WorldCup\Model\Enum\Team;
use WorldCup\Model\ValueObject\Score;

require_once 'vendor/autoload.php';

$scoreBoard = new FootballScoreBoard(new DisplayHandler());

$match1 = new FootballMatch(Team::Mexico, Team::Canada);
$scoreBoard->startGame($match1);
$scoreBoard->updateScore($match1, new Score(0), new Score(5));

$match2 = new FootballMatch(Team::Spain, Team::Brazil);
$scoreBoard->startGame($match2);
$scoreBoard->updateScore($match2, new Score(10), new Score(2));

$match3 = new FootballMatch(Team::Germany, Team::France);
$scoreBoard->startGame($match3);
$scoreBoard->updateScore($match3, new Score(2), new Score(2));

$match4 = new FootballMatch(Team::Uruguay, Team::Italy);
$scoreBoard->startGame($match4);
$scoreBoard->updateScore($match4, new Score(6), new Score(6));

$match5 = new FootballMatch(Team::Argentina, Team::Australia);
$scoreBoard->startGame($match5);
$scoreBoard->updateScore($match5, new Score(3), new Score(1));

$scoreBoard->printSummaryTable();

$scoreBoard->finishGame($match1);
$scoreBoard->finishGame($match2);
$scoreBoard->finishGame($match3);
$scoreBoard->finishGame($match4);
$scoreBoard->finishGame($match5);


