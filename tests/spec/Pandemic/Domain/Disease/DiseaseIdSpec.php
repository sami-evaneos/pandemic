<?php

namespace spec\Pandemic\Domain\Disease;

use Pandemic\Domain\Common\Uuid;
use Pandemic\Domain\Disease\DiseaseId;
use PhpSpec\ObjectBehavior;

class DiseaseIdSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(DiseaseId::class);
        $this->beConstructedThrough('fromUuid', [anUuidFactory()->uuid4()]);
    }

    public function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(Uuid::class);
        $this->shouldHaveType(DiseaseId::class);
    }
}
