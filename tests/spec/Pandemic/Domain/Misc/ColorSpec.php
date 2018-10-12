<?php

namespace spec\Pandemic\Domain\Misc;

use Pandemic\Domain\Misc\Color;
use PhpSpec\ObjectBehavior;

class ColorSpec extends ObjectBehavior
{
    const RED_COLOR = 'red';
    const BLUE_COLOR = 'blue';
    const YELLOW_COLOR = 'yellow';
    const BLACK_COLOR = 'black';

    public function let()
    {
        $this->beConstructedWith(self::RED_COLOR);
        $this->beConstructedWith(self::BLUE_COLOR);
        $this->beConstructedWith(self::YELLOW_COLOR);
        $this->beConstructedWith(self::BLACK_COLOR);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Color::class);
    }

    public function it_cannot_be_constructed_from_a_non_valid_color()
    {
        $this->beConstructedWith('shit');
        $this
            ->shouldThrow(\DomainException::class)
            ->duringInstantiation();
    }

    public function it_exposes_its_color()
    {
        $this->__toString()->shouldReturn(self::BLACK_COLOR);
    }

    public function it_tests_equality()
    {
        $this->equals(aYellowColor())->shouldReturn(false);
        $this->equals(aBlackColor())->shouldReturn(true);
    }
}
