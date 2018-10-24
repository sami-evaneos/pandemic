<?php

namespace Pandemic\Domain\City;

/**
 * @final
 * @package Pandemic\Domain\City
 */
final class CityDiseases
{
    /**
     * @var array<string, int>
     */
    private $diseases;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->diseases = array_fill_keys(Disease::AVAILABLE_DISEASES, 0);
    }

    /**
     * @param  Disease $disease
     *
     * @return int
     */
    public function countDiseases(Disease $disease) : int
    {
        return $this->diseases[(string) $disease];
    }

    /**
     * @param  Disease $disease
     *
     * @return bool
     */
    public function hasDisease(Disease $disease) : bool
    {
        return $this->diseases[(string) $disease] > 0;
    }

    /**
     * @param  Disease $cityDisease
     *
     * @return CityDiseases
     */
    public function add(Disease $cityDisease) : CityDiseases
    {
        ++$this->diseases[(string) $cityDisease];

        return $this;
    }
}
