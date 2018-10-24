<?php

namespace spec\Pandemic\Domain\Disease;

use League\Event\GeneratorInterface;
use Pandemic\Domain\Common\Clock;
use Pandemic\Domain\City\Disease;
use Pandemic\Domain\Disease\DiseaseId;
use Pandemic\Domain\Misc\Color;
use PhpSpec\ObjectBehavior;

class DiseaseSpec extends ObjectBehavior
{
    public function let()
    {
        // Act
        $this->beConstructedThrough('red');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Disease::class);
    }

    public function it_exposes_its_color()
    {
        $this->__toString()->shouldReturn(Disease::RED);
    }
}
