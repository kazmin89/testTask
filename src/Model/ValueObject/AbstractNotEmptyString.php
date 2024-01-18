<?php

declare(strict_types=1);

namespace WorldCup\Model\ValueObject;

abstract class AbstractNotEmptyString
{
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if ('' === $value) {
            throw new \InvalidArgumentException('value');
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
