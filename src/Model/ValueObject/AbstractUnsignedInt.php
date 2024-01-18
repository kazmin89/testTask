<?php

declare(strict_types=1);

namespace WorldCup\Model\ValueObject;

abstract class AbstractUnsignedInt
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('value', $value);
        }
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
