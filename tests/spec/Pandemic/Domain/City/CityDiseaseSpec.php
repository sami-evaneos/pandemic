<?php

namespace spec\Pandemic\Domain\City;

use Pandemic\Domain\City\CityDisease;
use Pandemic\Domain\City\CityId;
use Pandemic\Domain\Disease\DiseaseId;
use Pandemic\Domain\Misc\Color;
use PhpSpec\ObjectBehavior;

class CityDiseaseSpec extends ObjectBehavior
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
     * @return void
     */
    public function __construct()
    {
        $this->cityId = aCityId();
        $this->diseaseId = aDiseaseId();
        $this->color = aBlueColor();
    }

    public function let()
    {
        $this->beConstructedThrough('infection', [
            $this->cityId,
            $this->diseaseId,
            $this->color,
        ]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CityDisease::class);
    }

    public function it_knows_the_city()
    {
        $this->cityId()->shouldReturn($this->cityId);
    }

    public function it_knows_the__disease()
    {
        $this->diseaseId()->shouldReturn($this->diseaseId);
    }

    public function it_knows_the_disease_color()
    {
        $this->color()->shouldReturn($this->color);
    }

    public function it_tests_the_equality_with_an_other_instance()
    {
        $this
            ->equals(CityDisease::infection(aCityId(), aDiseaseId(), aYellowColor()))
            ->shouldReturn(false);
        $this
            ->equals(CityDisease::infection($this->cityId, $this->diseaseId, $this->color))
            ->shouldReturn(true);
    }
}
