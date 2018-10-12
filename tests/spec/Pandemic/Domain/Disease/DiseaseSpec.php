<?php

namespace spec\Pandemic\Domain\Disease;

use League\Event\GeneratorInterface;
use Pandemic\Domain\Common\Clock;
use Pandemic\Domain\Disease\Disease;
use Pandemic\Domain\Disease\DiseaseId;
use Pandemic\Domain\Misc\Color;
use PhpSpec\ObjectBehavior;

class DiseaseSpec extends ObjectBehavior
{
    /**
     * @var DiseaseId
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
        $this->id = aDiseaseId();
        $this->color = aBlackColor();
    }

    public function let(Clock $clock)
    {
        // Arrange
        $now = (new \tests\Service\Clock())->now();
        $clock->now()->willReturn($now);
        $diseaseDeveloped = aDiseaseDeveloped($this->id, $this->color, $now);

        // Act
        $this->beConstructedThrough('fromColor', [
            $this->id,
            $this->color,
            $clock
        ]);

        // Assert
        $this
            ->releaseEvents()
            ->shouldBeLike([$diseaseDeveloped]);
    }

    public function it_is_initializable()
    {
        $this->shouldImplement(GeneratorInterface::class);
        $this->shouldHaveType(Disease::class);
    }

    public function it_exposes_its_id()
    {
        $this->id()->shouldReturn($this->id);
    }

    public function it_exposes_its_color()
    {
        $this->color()->shouldReturn($this->color);
    }
}
