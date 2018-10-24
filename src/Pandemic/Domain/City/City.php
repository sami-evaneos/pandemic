<?php

namespace Pandemic\Domain\City;

use League\Event\EventInterface;
use League\Event\GeneratorInterface;
use League\Event\GeneratorTrait;
use Pandemic\Domain\Common\Clock;

/**
 * @final
 * @package Pandemic\Domain\City
 */
final class City implements GeneratorInterface
{
    use GeneratorTrait;

    const MAX_INFECTION_LEVEL = 3;

    /**
     * @var CityId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Disease
     */
    private $defaultDisease;

    /**
     * @var CityDiseases
     */
    private $diseases;

    /**
     * Constructor.
     *
     * @param  CityId  $cityId
     * @param  string  $name
     * @param  Disease $defaultDisease
     *
     * @return void
     */
    public function __construct(
        CityId $cityId,
        string $name,
        Disease $defaultDisease
    ) {
        $this->id = $cityId;
        $this->name = $name;
        $this->defaultDisease = $defaultDisease;
        $this->diseases = new CityDiseases();
    }

    /**
     * @param  Clock     $clock
     *
     * @return void
     *
     * @throws \DomainException If the city has already infected the current city.
     */
    public function infect(Clock $clock): void
    {
        $this->infection($this->defaultDisease, $clock->now());
    }

    /**
     * @param Disease $disease
     *
     * @param \DateTimeImmutable $date
     */
    public function outbreakFallout(Disease $disease, \DateTimeImmutable $date): void
    {
        $this->infection($disease, $date);
    }

    /**
     * @param Disease $disease
     * @param \DateTimeImmutable $date
     */
    private function infection(Disease $disease, \DateTimeImmutable $date): void
    {
        if ($this->diseases->countDiseases($disease) === self::MAX_INFECTION_LEVEL) {
            $this->apply(new CityOutbroke($this->id, $disease, $date));

            return;
        }

        $this->apply(new CityInfected($this->id, $disease, $date));
    }

    /**
     * @param CityInfected $event
     */
    private function applyCityInfected(CityInfected $event): void
    {
        $this->diseases->add($this->defaultDisease);
    }

    private function apply(EventInterface $event): void
    {
        $this->dispatchEvent($event);
        $this->addEvent($event);
    }

    private function dispatchEvent(EventInterface $event): void
    {
        $className = get_class($event);
        $splitClassName = explode('\\', $className);
        $functionName = 'apply' . end($splitClassName);

        if (method_exists($this, $functionName)) {
            $this->{$functionName}($event);
        }
    }
}
