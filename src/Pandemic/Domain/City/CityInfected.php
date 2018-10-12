<?php

namespace Pandemic\Domain\City;

use League\Event\AbstractEvent;
use Pandemic\Domain\Disease\DiseaseId;

class CityInfected extends AbstractEvent
{
    const NAME = 'city.infected';

    /**
     * @var CityId
     */
    private $cityId;

    /**
     * @var DiseaseId
     */
    private $diseaseId;

    /**
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    /**
     * Constructor.
     *
     * @param  CityId             $cityId
     * @param  DiseaseId          $diseaseId
     * @param  \DateTimeImmutable $occurredOn
     *
     * @return void
     */
    public function __construct(CityId $cityId, DiseaseId $diseaseId, \DateTimeImmutable $occurredOn)
    {
        $this->cityId = $cityId;
        $this->diseaseId = $diseaseId;
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
     * @return CityId
     */
    public function cityId() : CityId
    {
        return $this->cityId;
    }

    /**
     * @return DiseaseId
     */
    public function diseaseId() : DiseaseId
    {
        return $this->diseaseId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn() : \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
