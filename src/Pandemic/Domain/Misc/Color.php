<?php

namespace Pandemic\Domain\Misc;

/**
 * @final
 * @package Pandemic\Domain\Misc
 */
final class Color
{
    const RED = 'red';
    const BLUE = 'blue';
    const YELLOW = 'yellow';
    const BLACK = 'black';
    const AVAILABLE_COLORS = [
        self::RED,
        self::BLUE,
        self::BLACK,
        self::YELLOW,
    ];

    /**
     * @var string
     */
    private $color;

    /**
     * Constructor.
     *
     * @param  string $color
     *
     * @return void
     *
     * @throws \DomainException If the color is not supported.
     */
    public function __construct(string $color)
    {
        if (!in_array($color, self::AVAILABLE_COLORS, true)) {
            throw new \DomainException(sprintf('Value "%s" is not a supported color.', $color));
        }

        $this->color = $color;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString() : string
    {
        return $this->color;
    }

    /**
     * @param  Color $anotherColor
     *
     * @return bool
     */
    public function equals(Color $anotherColor) : bool
    {
        return $this->color === $anotherColor->color;
    }
}
