<?php

namespace spec\Pandemic\Domain\City;

use Pandemic\Domain\City\CityDiseases;
use PhpSpec\ObjectBehavior;

class CityDiseasesSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();

        foreach (allDiseases() as $disease) {
            $this->countDiseases($disease)->shouldReturn(0);
        }
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CityDiseases::class);
    }

    public function it_adds_a_new_city_disease()
    {
        // Arrange
        $disease = aRedDisease();

        // Act
        $this->add($disease)->shouldReturn($this);

        // Assert
        $this->hasDisease($disease)->shouldReturn(true);
        $this->countDiseases($disease)->shouldReturn(1);
    }

    public function it_adds_different_city_diseases()
    {
        // Arrange
        $redDisease = aRedDisease();
        $yellowDisease = aYellowDisease();

        // Act
        $this->add($redDisease)
             ->add($yellowDisease);

        // Assert
        $this->hasDisease($redDisease)->shouldReturn(true);
        $this->countDiseases($redDisease)->shouldReturn(1);

        $this->hasDisease($yellowDisease)->shouldReturn(true);
        $this->countDiseases($yellowDisease)->shouldReturn(1);
        $this->countDiseases(aBlueDisease())->shouldReturn(0);
    }
}
