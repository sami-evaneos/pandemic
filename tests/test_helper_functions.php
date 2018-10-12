<?php

/**
 * @return \Ramsey\Uuid\UuidFactory
 */
function anUuidFactory() : \Ramsey\Uuid\UuidFactory
{
    static $factory;

    if (!$factory) {
        $factory = new \Ramsey\Uuid\UuidFactory();
    }

    return $factory;
}

/**
 * @return DateTimeImmutable
 */
function now() : DateTimeImmutable
{
    return (new \tests\Service\Clock())->now();
}

/**
 * @return \Pandemic\Domain\Misc\Color[]
 */
function allColors() : array
{
    $colors = [];

    foreach (\Pandemic\Domain\Misc\Color::AVAILABLE_COLORS as $color) {
        $colors[] = new \Pandemic\Domain\Misc\Color($color);
    }

    return $colors;
}

/**
 * @return \Pandemic\Domain\Misc\Color
 */
function aRedColor() : \Pandemic\Domain\Misc\Color
{
    return new \Pandemic\Domain\Misc\Color(\Pandemic\Domain\Misc\Color::RED);
}

/**
 * @return \Pandemic\Domain\Misc\Color
 */
function aBlackColor() : \Pandemic\Domain\Misc\Color
{
    return new \Pandemic\Domain\Misc\Color(\Pandemic\Domain\Misc\Color::BLACK);
}

/**
 * @return \Pandemic\Domain\Misc\Color
 */
function aBlueColor() : \Pandemic\Domain\Misc\Color
{
    return new \Pandemic\Domain\Misc\Color(\Pandemic\Domain\Misc\Color::BLUE);
}

/**
 * @return \Pandemic\Domain\Misc\Color
 */
function aYellowColor() : \Pandemic\Domain\Misc\Color
{
    return new \Pandemic\Domain\Misc\Color(\Pandemic\Domain\Misc\Color::YELLOW);
}

/**
 * @return \Pandemic\Domain\Disease\DiseaseId
 */
function aDiseaseId() : \Pandemic\Domain\Disease\DiseaseId
{
    return \Pandemic\Domain\Disease\DiseaseId::fromString(anUuidFactory()->uuid4());
}

/**
 * @return \tests\Builder\DiseaseBuilder
 */
function aDisease() : \tests\Builder\DiseaseBuilder
{
    return new \tests\Builder\DiseaseBuilder();
}

/**
 * @param  \Pandemic\Domain\Disease\DiseaseId $diseaseId
 * @param  \Pandemic\Domain\Misc\Color        $color
 * @param  DateTimeImmutable                  $occurredOn
 *
 * @return \Pandemic\Domain\Disease\DiseaseDeveloped
 */
function aDiseaseDeveloped(
    \Pandemic\Domain\Disease\DiseaseId $diseaseId,
    \Pandemic\Domain\Misc\Color $color,
    \DateTimeImmutable $occurredOn
) : \Pandemic\Domain\Disease\DiseaseDeveloped
{
    return new \Pandemic\Domain\Disease\DiseaseDeveloped($diseaseId, $color, $occurredOn);
}

/**
 * @return \Pandemic\Domain\City\CityId
 */
function aCityId() : \Pandemic\Domain\City\CityId
{
    return \Pandemic\Domain\City\CityId::fromUuid(anUuidFactory()->uuid4());
}

/**
 * @return \tests\Builder\CityBuilder
 */
function aCity() : \tests\Builder\CityBuilder
{
    return new \tests\Builder\CityBuilder();
}

/**
 * @param  \Pandemic\Domain\City\CityId       $cityId
 * @param  \Pandemic\Domain\Disease\DiseaseId $diseaseId
 * @param  DateTimeImmutable                  $occurredOn
 *
 * @return \Pandemic\Domain\City\CityOutbroke
 */
function aCityOutbroke(
    \Pandemic\Domain\City\CityId $cityId,
    \Pandemic\Domain\Disease\DiseaseId $diseaseId,
    \DateTimeImmutable $occurredOn
) : \Pandemic\Domain\City\CityOutbroke
{
    return new \Pandemic\Domain\City\CityOutbroke($cityId, $diseaseId, $occurredOn);
}

/**
 * @param  \Pandemic\Domain\City\CityId       $cityId
 * @param  \Pandemic\Domain\Disease\DiseaseId $diseaseId
 * @param  DateTimeImmutable                  $occurredOn
 *
 * @return \Pandemic\Domain\City\CityInfected
 */
function aCityInfected(
    \Pandemic\Domain\City\CityId $cityId,
    \Pandemic\Domain\Disease\DiseaseId $diseaseId,
    \DateTimeImmutable $occurredOn
) : \Pandemic\Domain\City\CityInfected
{
    return new \Pandemic\Domain\City\CityInfected($cityId, $diseaseId, $occurredOn);
}

/**
 * @param  \tests\Builder\TestBuilder $aBuilder
 *
 * @return mixed
 */
function build(\tests\Builder\TestBuilder $aBuilder)
{
    return $aBuilder->build();
}
