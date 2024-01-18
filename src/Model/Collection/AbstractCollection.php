<?php

declare(strict_types=1);

namespace WorldCup\Model\Collection;


abstract class AbstractCollection implements \Iterator
{
    protected array $array;

    public function __construct(array $data = [])
    {
        $this->array = $data;
    }

    public function rewind(): mixed
    {
        return \reset($this->array);
    }

    public function end(): mixed
    {
        return \end($this->array);
    }

    public function current(): mixed
    {
        return \current($this->array);
    }

    public function key(): mixed
    {
        return \key($this->array);
    }

    public function next(): mixed
    {
        return \next($this->array);
    }

    public function valid(): bool
    {
        return null !== \key($this->array);
    }

    public function getArrayCopy(): array
    {
        return $this->array;
    }

    public function __set($item, $value): void
    {
        throw new \LogicException(__METHOD__ . ' no magic setter here');
    }

    public function __get($item): void
    {
        throw new \LogicException(__METHOD__ . ' no magic getter here');
    }
}
