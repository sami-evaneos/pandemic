<?php

namespace spec\Pandemic\Domain\City;

use League\Event\GeneratorInterface;
use Pandemic\Domain\City\City;
use Pandemic\Domain\City\CityId;
use Pandemic\Domain\City\Disease;
use Pandemic\Domain\Common\Clock;
use PhpSpec\ObjectBehavior;

class CitySpec extends ObjectBehavior
{
    const NAME = 'Tokyo';

    /**
     * @var CityId
     */
    private $id;

    /**
     * @var Disease
     */
    private $defaultDisease;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->id = aCityId();
        $this->defaultDisease = aBlackDisease();
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->id,
            self::NAME,
            $this->defaultDisease
        );
    }

    public function it_is_initializable()
    {
        $this->shouldImplement(GeneratorInterface::class);
        $this->shouldHaveType(City::class);
    }

    public function it_can_be_infected_by_its_default_disease(Clock $clock)
    {
        // Arrange
        $now = (new \tests\Service\Clock())->now();
        $clock->now()->willReturn($now);
        /** @var Disease $aDisease */
        $aCityInfected = aCityInfected($this->id, $this->defaultDisease, $now);

        // Act
        $this->infect($clock);

        // Assert
        $this
            ->releaseEvents()
            ->shouldBeLike([$aCityInfected]);
    }

    public function it_can_outbreak_if_infected_more_than_three_times(Clock $clock)
    {
        // Arrange
        $now = (new \tests\Service\Clock())->now();
        $clock->now()->willReturn($now);

        $aCityInfected = aCityInfected($this->id, $this->defaultDisease, $now);
        $aSecondCityInfected = aCityInfected($this->id, $this->defaultDisease, $now);
        $aThirdCityInfected = aCityInfected($this->id, $this->defaultDisease, $now);
        $aCityOutbroke = aCityOutbroke($this->id, $this->defaultDisease, $now);

        // Act
        $this->infect($clock);
        $this->infect($clock);
        $this->infect($clock);
        $this->infect($clock); // 4th time

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
