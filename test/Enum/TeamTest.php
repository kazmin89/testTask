<?php

declare(strict_types=1);

namespace WorldCup\Model\Enum\Test;

use PHPUnit\Framework\TestCase;
use WorldCup\Model\Enum\Team;

class TeamTest extends TestCase
{
    public function testEnumValues(): void
    {
        $expectedValues = [
            'Mexico',
            'Spain',
            'Germany',
            'Uruguay',
            'Argentina',
            'Canada',
            'Brazil',
            'France',
            'Italy',
            'Australia',
        ];

        foreach (Team::cases() as $team) {
            $this->assertContains($team->value, $expectedValues);
        }
    }

    public function testEnumInstances(): void
    {
        $expectedInstances = [
            Team::Mexico,
            Team::Spain,
            Team::Germany,
            Team::Uruguay,
            Team::Argentina,
            Team::Canada,
            Team::Brazil,
            Team::France,
            Team::Italy,
            Team::Australia,
        ];

        foreach (Team::cases() as $team) {
            $this->assertContains($team, $expectedInstances);
        }
    }
}
