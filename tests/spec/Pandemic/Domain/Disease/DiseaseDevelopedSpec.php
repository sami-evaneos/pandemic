<?php

namespace spec\Pandemic\Domain\Disease;

use League\Event\AbstractEvent;
use Pandemic\Domain\Disease\DiseaseDeveloped;
use Pandemic\Domain\Disease\DiseaseId;
use Pandemic\Domain\Misc\Color;
use PhpSpec\ObjectBehavior;

class DiseaseDevelopedSpec extends ObjectBehavior
{
    /**
     * @var DiseaseId
     */
    private $diseaseId;

    /**
     * @var Color
     */
    private $color;

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
        $this->diseaseId = aDiseaseId();
        $this->color = aRedColor();
        $this->occurredOn = now();
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->diseaseId,
            $this->color,
            $this->occurredOn
        );
    }

    public function it_is_initializable()
    {
        $this->shouldImplement(AbstractEvent::class);
        $this->shouldHaveType(DiseaseDeveloped::class);
    }

    public function it_has_a_disease_id()
    {
        $this->diseaseId()->shouldReturn($this->diseaseId);
    }

    public function it_has_a_color_id()
    {
        $this->color()->shouldReturn($this->color);
    }

    public function it_has_an_occurred_on()
    {
        $this->occurredOn()->shouldReturn($this->occurredOn);
    }
}
