<?php

declare(strict_types=1);

namespace WorldCup\Model\Collection;

use WorldCup\Model\Data\FootballMatch;

/**
 * @method FootballMatch current()
 */
class FootballMatchCollection extends AbstractCollection
{
    public function __construct(FootballMatch ...$footballMatchCollection)
    {
        parent::__construct();
        foreach ($footballMatchCollection as $item) {
            $this->addItem($item);
        }
    }

    public function addItem(FootballMatch $item): void
    {
        $this->array[$item->getMatchTitle()->getValue()] = $item;
    }

    public function contains(FootballMatch $item)
    {
        return \array_key_exists($item->getMatchTitle()->getValue(), $this->array);
    }

    public function deleteItem(FootballMatch $item): void
    {
        if (!$this->contains($item)) {
            throw new \LogicException('Match does not exist');
        }

        unset($this->array[$item->getMatchTitle()->getValue()]);
    }
}