<?php

namespace tests\Builder;

use League\Event\GeneratorInterface;
use Pandemic\Domain\City\City;
use Pandemic\Domain\City\CityId;
use Pandemic\Domain\Misc\Color;

/**
 * @final
 * @package tests\Builder
 */
final class CityBuilder implements TestBuilder
{
    /**
     * @var CityId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Color
     */
    private $color;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->id = aCityId();
        $this->name = 'Paris';
        $this->color = aYellowColor();
    }

    /**
     * @param  CityId $cityId
     *
     * @return void
     */
    public function withId(CityId $cityId) : void
    {
        $this->id = $cityId;
    }

    /**
     * @param  string $name
     *
     * @return void
     */
    public function withName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @param  Color $color
     *
     * @return void
     */
    public function withColor(Color $color) : void
    {
        $this->color = $color;
    }

    /**
     * @return GeneratorInterface
     */
    public function build() : GeneratorInterface
    {
        return new City(
            $this->id,
            $this->name,
            $this->color
        );
    }
}
