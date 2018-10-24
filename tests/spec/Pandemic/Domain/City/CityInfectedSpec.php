<?php

namespace spec\Pandemic\Domain\City;

use League\Event\AbstractEvent;
use Pandemic\Domain\City\CityId;
use Pandemic\Domain\City\CityInfected;
use Pandemic\Domain\City\Disease;
use PhpSpec\ObjectBehavior;

class CityInfectedSpec extends ObjectBehavior
{
    /**
     * @var CityId
     */
    private $cityId;

    /**
     * @var Disease
     */
    private $disease;

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
        $this->disease = aRedDisease();
        $this->occurredOn = now();
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->cityId,
            $this->disease,
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

    public function it_has_a_disease()
    {
        $this->disease()->shouldReturn($this->disease);
    }

    public function it_has_an_occurred_on()
    {
        $this->occurredOn()->shouldReturn($this->occurredOn);
    }
}
