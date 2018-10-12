<?php

namespace Pandemic\Domain\City;

use Pandemic\Domain\Disease\DiseaseId;
use Pandemic\Domain\Misc\Color;

/**
 * @final
 * @package Pandemic\Domain\City
 */
final class CityDisease
{
    /**
     * @var CityId
     */
    private $cityId;

    /**
     * @var DiseaseId
     */
    private $diseaseId;

    /**
     * @var Color
     */
    private $color;

    /**
     * Constructor.
     *
     * @param  CityId    $cityId
     * @param  DiseaseId $diseaseId
     * @param  Color     $color
     *
     * @return void
     */
    private function __construct(
        CityId $cityId,
        DiseaseId $diseaseId,
        Color $color
    ) {
        $this->cityId = $cityId;
        $this->diseaseId = $diseaseId;
        $this->color = $color;
    }

    /**
     * @param  DiseaseId $diseaseId
     * @param  Color     $color
     *
     * @return CityDisease
     */
    public static function infection(
        CityId $cityId,
        DiseaseId $diseaseId,
        Color $color
    ) : CityDisease
    {
        return new self($cityId, $diseaseId, $color);
    }

    /**
     * @return CityId
     */
    public function cityId() : CityId
    {
        return $this->cityId;
    }

    /**
     * @return DiseaseId
     */
    public function diseaseId() : DiseaseId
    {
        return $this->diseaseId;
    }

    /**
     * @return Color
     */
    public function color() : Color
    {
        return $this->color;
    }

    /**
     * @param  CityDisease $anotherCityDisease
     *
     * @return bool
     */
    public function equals(CityDisease $anotherCityDisease) : bool
    {
        return
            $this->cityId->equals($anotherCityDisease->cityId)
            && $this->diseaseId->equals($anotherCityDisease->diseaseId)
            && $this->color->equals($anotherCityDisease->color);
    }
}
