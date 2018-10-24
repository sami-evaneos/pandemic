<?php

namespace Pandemic\Domain\City;

/**
 * @final
 * @package Pandemic\Domain\Disease
 */
final class Disease
{
    const RED = 'red';
    const BLUE = 'blue';
    const YELLOW = 'yellow';
    const BLACK = 'black';
    const AVAILABLE_DISEASES = [ self::RED, self::BLUE, self::BLACK, self::YELLOW ];

    /** @var string */
    private $name;

    /**
     * Disease constructor.
     *
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param Disease $disease
     *
     * @return bool
     */
    public function equals(Disease $disease): bool
    {
        return $disease->name === $this->name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Disease
     */
    public static function red(): Disease
    {
        return new self(self::RED);
    }

    /**
     * @return Disease
     */
    public static function blue(): Disease
    {
        return new self(self::BLUE);
    }

    /**
     * @return Disease
     */
    public static function yellow(): Disease
    {
        return new self(self::YELLOW);
    }

    /**
     * @return Disease
     */
    public static function black(): Disease
    {
        return new self(self::BLACK);
    }
}
