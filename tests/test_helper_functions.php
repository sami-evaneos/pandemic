<?php

use Pandemic\Domain\City\CityId;
use Pandemic\Domain\City\CityInfected;
use Pandemic\Domain\City\CityOutbroke;
use Pandemic\Domain\City\Disease;
use Ramsey\Uuid\UuidFactory;
use tests\Builder\CityBuilder;
use tests\Builder\TestBuilder;
use tests\Service\Clock;

/**
 * @return UuidFactory
 */
function anUuidFactory() : UuidFactory
{
    static $factory;

    if (!$factory) {
        $factory = new UuidFactory();
    }

    return $factory;
}

/**
 * @return DateTimeImmutable
 */
function now() : DateTimeImmutable
{
    return (new Clock())->now();
}

/**
 * @return Disease[]
 */
function allDiseases() : array
{
    return [ Disease::red(), Disease::yellow(), Disease::black(), Disease::blue() ];
}

/**
 * @return Disease
 */
function aRedDisease() : Disease
{
    return Disease::red();
}

/**
 * @return Disease
 */
function aBlueDisease() : Disease
{
    return Disease::blue();
}

/**
 * @return Disease
 */
function aBlackDisease() : Disease
{
    return Disease::black();
}

/**
 * @return Disease
 */
function aYellowDisease() : Disease
{
    return Disease::yellow();
}

/**
 * @return CityId
 */
function aCityId() : CityId
{
    return CityId::fromUuid(anUuidFactory()->uuid4());
}

/**
 * @return CityBuilder
 */
function aCity() : CityBuilder
{
    return new CityBuilder();
}

/**
 * @param  CityId            $cityId
 * @param  Disease           $disease
 * @param  DateTimeImmutable $occurredOn
 *
 * @return CityOutbroke
 */
function aCityOutbroke(
    CityId $cityId,
    Disease $disease,
    \DateTimeImmutable $occurredOn
) : CityOutbroke
{
    return new CityOutbroke($cityId, $disease, $occurredOn);
}

/**
 * @param  CityId            $cityId
 * @param  Disease           $disease
 * @param  DateTimeImmutable $occurredOn
 *
 * @return CityInfected
 */
function aCityInfected(
    CityId $cityId,
    Disease $disease,
    \DateTimeImmutable $occurredOn
) : CityInfected
{
    return new CityInfected($cityId, $disease, $occurredOn);
}

/**
 * @param  TestBuilder $aBuilder
 *
 * @return mixed
 */
function build(TestBuilder $aBuilder)
{
    return $aBuilder->build();
}
