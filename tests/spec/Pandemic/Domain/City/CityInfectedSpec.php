<?php

namespace spec\Pandemic\Domain\City;

use League\Event\AbstractEvent;
use Pandemic\Domain\City\CityId;
use Pandemic\Domain\City\CityInfected;
use Pandemic\Domain\Disease\DiseaseId;
use PhpSpec\ObjectBehavior;

class CityInfectedSpec extends ObjectBehavior
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
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cityId = aCityId();
        $this->diseaseId = aDiseaseId();
        $this->occurredOn = now();
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->cityId,
            $this->diseaseId,
            $this->occurredOn
        );
    }

    public function it_is_initializable()
    {
        $this->shouldImplement(AbstractEvent::class);
        $this->shouldHaveType(CityInfected::class);
    }

    public function it_has_an_event_name()
    {
        $this->getName()->shouldReturn('city.infected');
    }

    public function it_has_city_id()
    {
        $this->cityId()->shouldReturn($this->cityId);
    }

    public function it_has_a_disease_id()
    {
        $this->diseaseId()->shouldReturn($this->diseaseId);
    }

    public function it_has_an_occurred_on()
    {
        $this->occurredOn()->shouldReturn($this->occurredOn);
    }
}
