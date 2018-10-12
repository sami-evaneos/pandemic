<?php

namespace Pandemic\Domain\Disease;

use League\Event\GeneratorInterface;
use League\Event\GeneratorTrait;
use Pandemic\Domain\Common\Clock;
use Pandemic\Domain\Misc\Color;

/**
 * @final
 * @package Pandemic\Domain\Disease
 */
final class Disease implements GeneratorInterface
{
    use GeneratorTrait;

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
     * @param  DiseaseId $diseaseId
     * @param  Color     $color
     *
     * @return void
     */
    private function __construct(DiseaseId $diseaseId, Color $color)
    {
        $this->id = $diseaseId;
        $this->color = $color;
    }

    /**
     * @param  DiseaseId $diseaseId
     * @param  Color     $color
     * @param  Clock     $clock
     *
     * @return Disease
     */
    public static function fromColor(
        DiseaseId $diseaseId,
        Color $color,
        Clock $clock
    ) : Disease
    {
        return (new self($diseaseId, $color))
            ->addEvent(new DiseaseDeveloped($diseaseId, $color, $clock->now()));
    }

    /**
     * @return DiseaseId
     */
    public function id() : DiseaseId
    {
        return $this->id;
    }

    /**
     * @return Color
     */
    public function color() : Color
    {
        return $this->color;
    }

    /**
     * {@inheritDoc}
     */
    public function releaseEvents()
    {
        return $this->events;
    }
}
