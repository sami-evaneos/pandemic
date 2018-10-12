<?php

namespace tests\Builder;

use League\Event\GeneratorInterface;
use Pandemic\Domain\Common\Clock;
use Pandemic\Domain\Disease\Disease;
use Pandemic\Domain\Disease\DiseaseId;
use Pandemic\Domain\Misc\Color;

/**
 * @final
 * @package tests\Builder
 */
final class DiseaseBuilder implements TestBuilder
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
     * @var Clock
     */
    private $clock;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->id = aDiseaseId();
        $this->color = aRedColor();
        $this->clock = new Clock();
    }

    /**
     * @param  DiseaseId $diseaseId
     *
     * @return void
     */
    public function withId(DiseaseId $diseaseId) : void
    {
        $this->id = $diseaseId;
    }

    /**
     * @param  Color $color
     *
     * @return void
     */
    public function withColor(Color $color) : void
    {
        $this->color = $color;
    }

    /**
     * @param  Clock $clock
     *
     * @return void
     */
    public function withClock(Clock $clock) : void
    {
        $this->clock = $clock;
    }

    /**
     * @return GeneratorInterface
     */
    public function build() : GeneratorInterface
    {
        return Disease::fromColor(
            $this->id,
            $this->color,
            $this->clock
        );
    }
}
