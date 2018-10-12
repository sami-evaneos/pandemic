<?php

namespace spec\Pandemic\Domain\City;

use Pandemic\Domain\City\CityDisease;
use Pandemic\Domain\City\CityDiseases;
use PhpSpec\ObjectBehavior;

class CityDiseasesSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();

        foreach (allColors() as $color) {
            $this->countDiseasesForColor($color)->shouldReturn(0);
        }
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CityDiseases::class);
    }

    public function it_adds_a_new_city_disease()
    {
        // Arrange
        $cityId = aCityId();
        $diseaseId = aDiseaseId();
        $color = aRedColor();
        $cityDisease = CityDisease::infection($cityId, $diseaseId, $color);

        // Act
        $this->add($cityDisease)->shouldReturn($this);

        // Assert
        $this->hasDisease($diseaseId)->shouldReturn(true);
        $this->hasDiseaseForColor($diseaseId, $color)->shouldReturn(true);
        $this->countDiseasesForColor($color)->shouldReturn(1);
    }

    public function it_adds_different_city_diseases()
    {
        // Arrange
        $cityId = aCityId();
        $diseaseId = aDiseaseId();
        $color = aRedColor();
        $anotherCityId = aCityId();
        $anotherDiseaseId = aDiseaseId();
        $anotherColor = aYellowColor();
        $cityDisease = CityDisease::infection($cityId, $diseaseId, $color);
        $anotherCityDisease = CityDisease::infection($anotherCityId, $anotherDiseaseId, $anotherColor);

        // Act
        $this->add($cityDisease)
            ->add($anotherCityDisease);

        // Assert
        $this->hasDisease($diseaseId)->shouldReturn(true);
        $this->hasDiseaseForColor($diseaseId, $color)->shouldReturn(true);
        $this->countDiseasesForColor($color)->shouldReturn(1);

        $this->hasDisease($anotherDiseaseId)->shouldReturn(true);
        $this->hasDiseaseForColor($anotherDiseaseId, $color)->shouldReturn(false);
        $this->hasDiseaseForColor($anotherDiseaseId, $anotherColor)->shouldReturn(true);
        $this->countDiseasesForColor($anotherColor)->shouldReturn(1);
        $this->countDiseasesForColor(aBlueColor())->shouldReturn(0);
    }
}
