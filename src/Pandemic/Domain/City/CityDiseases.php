<?php

namespace Pandemic\Domain\City;

use Pandemic\Domain\Disease\DiseaseId;
use Pandemic\Domain\Misc\Color;

/**
 * @final
 * @package Pandemic\Domain\City
 */
final class CityDiseases
{
    /**
     * @var array<string, CityDisease>
     */
    private $diseases;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->diseases = array_fill_keys(Color::AVAILABLE_COLORS, []);
    }

    /**
     * @param  Color $diseaseColor
     *
     * @return null|CityDisease[]
     */
    private function allByColor(Color $diseaseColor) :? array
    {
        return $this->diseases[(string) $diseaseColor] ?? null;
    }

    /**
     * @param  Color $color
     *
     * @return int
     */
    public function countDiseasesForColor(Color $color) : int
    {
        return count($this->allByColor($color));
    }

    /**
     * @param  DiseaseId $diseaseId
     * @param  Color     $color
     *
     * @return bool
     */
    public function hasDiseaseForColor(DiseaseId $diseaseId, Color $color) : bool
    {
        return !empty($this->allByColor($color)[(string) $diseaseId]);
    }

    /**
     * @param  DiseaseId $diseaseId
     *
     * @return bool
     */
    public function hasDisease(DiseaseId $diseaseId) : bool
    {
        /**
         * @var string      $diseaseColor
         * @var CityDisease $cityDisease
         */
        foreach ($this->diseases as $diseaseColor => $cityDisease) {
            if (isset($cityDisease[(string) $diseaseId])) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  CityDisease $newCityDisease
     *
     * @return CityDiseases
     */
    public function add(CityDisease $newCityDisease) : CityDiseases
    {
        $this->diseases[(string) $newCityDisease->color()][(string) $newCityDisease->diseaseId()] = $newCityDisease;

        return $this;
    }
}
