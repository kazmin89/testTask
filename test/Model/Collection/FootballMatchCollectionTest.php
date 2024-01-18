<?php

declare(strict_types=1);

namespace WorldCup\Model\Test\Collection;

use PHPUnit\Framework\TestCase;
use WorldCup\Model\Collection\FootballMatchCollection;
use WorldCup\Model\Data\FootballMatch;
use WorldCup\Model\Enum\Team;

class FootballMatchCollectionTest extends TestCase
{
    public function testAddItem(): void
    {
        $collection = new FootballMatchCollection();
        $footballMatch = new FootballMatch(Team::Argentina, Team::Mexico);
        $collection->addItem($footballMatch);

        $this->assertTrue($collection->contains($footballMatch));
    }

    public function deleteItemDataProvider(): \Traversable
    {
        $collection = new FootballMatchCollection();
        $footballMatch = new FootballMatch(Team::Argentina, Team::Mexico);
        $collection->addItem($footballMatch);

        $default = [
            'collection' => $collection,
            'footballMatch' => $footballMatch,
            'expectedException' => null,
        ];

        yield 'default case' => $default;

        yield 'delete undefined item' => \array_replace($default, [
            'footballMatch' => new FootballMatch(Team::Germany, Team::France),
            'expectedException' => \LogicException::class,
        ]);
    }

    /**
     * @dataProvider deleteItemDataProvider
     */
    public function testDeleteItem(
        FootballMatchCollection $collection,
        FootballMatch $footballMatch,
        ?string $expectedException,
    ): void {
        if (!\is_null($expectedException)) {
            $this->expectException($expectedException);
        }
        $collection->deleteItem($footballMatch);
        $this->assertFalse($collection->contains($footballMatch));
    }

    public function testContains(): void
    {
        $collection = new FootballMatchCollection();
        $footballMatch = new FootballMatch(Team::Argentina, Team::Mexico);
        $this->assertFalse($collection->contains($footballMatch));
        $collection->addItem($footballMatch);
        $this->assertTrue($collection->contains($footballMatch));
    }
}
