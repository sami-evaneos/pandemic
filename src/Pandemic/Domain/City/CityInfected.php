<?php

namespace Pandemic\Domain\City;

use League\Event\AbstractEvent;

class CityInfected extends AbstractEvent
{
    const NAME = 'city.infected';

    /**
     * @var CityId
     */
    private $cityId;

    /**
     * @var Disease
     */
    private $disease;

    /**
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    /**
     * Constructor.
     *
     * @param  CityId             $cityId
     * @param  Disease            $disease
     * @param  \DateTimeImmutable $occurredOn
     *
     * @return void
     */
    public function __construct(CityId $cityId, Disease $disease, \DateTimeImmutable $occurredOn)
    {
        $this->cityId = $cityId;
        $this->disease = $disease;
        $this->occurredOn = $occurredOn;
    }

    /**
     * {@inheritDoc}
     */
    public function getName() : string
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
     * @return Disease
     */
    public function disease() : Disease
    {
        return $this->disease;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn() : \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
