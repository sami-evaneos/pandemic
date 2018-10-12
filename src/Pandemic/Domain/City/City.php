<?php

namespace Pandemic\Domain\City;

use League\Event\GeneratorTrait;
use Pandemic\Domain\Common\Clock;
use Pandemic\Domain\Disease\DiseaseId;
use Pandemic\Domain\Misc\Color;
use League\Event\GeneratorInterface;

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
     * @var Color
     */
    private $color;

    /**
     * @var CityDiseases
     */
    private $diseases;

    /**
     * Constructor.
     *
     * @param  CityId $cityId
     * @param  string $name
     * @param  Color  $color
     *
     * @return void
     */
    public function __construct(
        CityId $cityId,
        string $name,
        Color $color
    ) {
        $this->id = $cityId;
        $this->name = $name;
        $this->color = $color;
        $this->diseases = new CityDiseases();
    }

    /**
     * {@inheritDoc}
     */
    public function releaseEvents()
    {
        return $this->events;
    }

    /**
     * @param  DiseaseId $diseaseId
     * @param  Color     $color
     *
     * @return bool
     */
    private function couldBeInfectedBy(DiseaseId $diseaseId, Color $color) : bool
    {
        return !$this->diseases->hasDisease($diseaseId)
            || !$this->diseases->hasDiseaseForColor($diseaseId, $color);
    }

    /**
     * @param  DiseaseId $diseaseId
     * @param  Color     $color
     * @param  Clock     $clock
     *
     * @return void
     *
     * @throws \DomainException If the city has already infected the current city.
     */
    public function beInfectedBy(DiseaseId $diseaseId, Color $color, Clock $clock)
    {
        if ($this->diseases->countDiseasesForColor($color) === self::MAX_INFECTION_LEVEL) {
            $this->addEvent(new CityOutbroke($this->id, $diseaseId, $clock->now()));

            return;
        }

        if (!$this->couldBeInfectedBy($diseaseId, $color)) {
            throw new \DomainException(
                sprintf(
                    'City (%s) has already been infected by Disease (%s).',
                    $this->id,
                    $diseaseId
                )
            );
        }

        $this->diseases->add(CityDisease::infection($this->id, $diseaseId, $color));

        $this->addEvent(new CityInfected($this->id, $diseaseId, $clock->now()));
    }
}
