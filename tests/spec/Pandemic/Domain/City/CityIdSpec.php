<?php

namespace spec\Pandemic\Domain\City;

use Pandemic\Domain\City\CityId;
use Pandemic\Domain\Common\Id;
use Pandemic\Domain\Common\Uuid;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CityIdSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(CityId::class);
        $this->beConstructedThrough('fromUuid', [anUuidFactory()->uuid4()]);
    }

    public function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(Uuid::class);
        $this->shouldHaveType(CityId::class);
    }
}
