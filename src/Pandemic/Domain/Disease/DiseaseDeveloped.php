<?php

namespace Pandemic\Domain\Disease;

use League\Event\AbstractEvent;
use Pandemic\Domain\Misc\Color;

/**
 * @final
 * @package Pandemic\Domain\Disease
 */
final class DiseaseDeveloped extends AbstractEvent
{
    const NAME = 'disease.developed';

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
     * @param  DiseaseId          $diseaseId
     * @param  Color              $color
     * @param  \DateTimeImmutable $occurredOn
     *
     * @return void
     */
    public function __construct(DiseaseId $diseaseId, Color $color, \DateTimeImmutable $occurredOn)
    {
        $this->diseaseId = $diseaseId;
        $this->color = $color;
        $this->occurredOn = $occurredOn;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @return DiseaseId
     */
    public function diseaseId() : DiseaseId
    {
        return $this->diseaseId;
    }

    /**
     * @return Color
     */
    public function color() : Color
    {
        return $this->color;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn() : \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
