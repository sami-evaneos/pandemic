<?php

namespace spec\Pandemic\Domain\City;

use League\Event\GeneratorInterface;
use Pandemic\Domain\City\City;
use Pandemic\Domain\City\CityId;
use Pandemic\Domain\Common\Clock;
use Pandemic\Domain\Disease\Disease;
use Pandemic\Domain\Misc\Color;
use PhpSpec\ObjectBehavior;

class CitySpec extends ObjectBehavior
{
    const NAME = 'Tokyo';

    /**
     * @var CityId
     */
    private $id;

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
        $this->id = aCityId();
        $this->color = aBlackColor();
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->id,
            self::NAME,
            $this->color
        );
    }

    public function it_is_initializable()
    {
        $this->shouldImplement(GeneratorInterface::class);
        $this->shouldHaveType(City::class);
    }

    public function it_can_be_infected_by_one_disease(Clock $clock)
    {
        // Arrange
        $now = (new \tests\Service\Clock())->now();
        $clock->now()->willReturn($now);
        /** @var Disease $aDisease */
        $aDisease = build(aDisease());
        $aCityInfected = aCityInfected($this->id, $aDisease->id(), $now);

        // Act
        $this->beInfectedBy($aDisease->id(), $aDisease->color(), $clock);

        // Assert
        $this
            ->releaseEvents()
            ->shouldBeLike([$aCityInfected]);
        $this
            ->shouldThrow(\DomainException::class)
            ->during('beInfectedBy', [
                $aDisease->id(),
                $aDisease->color(),
                $clock
            ]);
    }

    public function it_can_outbreaks(Clock $clock)
    {
        // Arrange
        $now = (new \tests\Service\Clock())->now();
        $clock->now()->willReturn($now);
        /** @var Disease $aDisease */
        $aDisease = build(aDisease());
        $aCityInfected = aCityInfected($this->id, $aDisease->id(), $now);
        /** @var Disease $aDisease */
        $aSecondDisease = build(aDisease());
        $aSecondCityInfected = aCityInfected($this->id, $aSecondDisease->id(), $now);
        /** @var Disease $aDisease */
        $aThirdDisease = build(aDisease());
        $aThirdCityInfected = aCityInfected($this->id, $aThirdDisease->id(), $now);
        /** @var Disease $aDisease */
        $aFourthDisease = build(aDisease());
        $aCityOutbroke = aCityOutbroke($this->id, $aFourthDisease->id(), $now);

        // Act
        $this->beInfectedBy($aDisease->id(), $aDisease->color(), $clock);
        $this->beInfectedBy($aSecondDisease->id(), $aSecondDisease->color(), $clock);
        $this->beInfectedBy($aThirdDisease->id(), $aThirdDisease->color(), $clock);
        $this->beInfectedBy($aFourthDisease->id(), $aFourthDisease->color(), $clock);

        // Assert
        $this
            ->releaseEvents()
            ->shouldBeLike([
                $aCityInfected,
                $aSecondCityInfected,
                $aThirdCityInfected,
                $aCityOutbroke,
            ]);
    }
}
