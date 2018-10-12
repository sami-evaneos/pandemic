<?php

namespace tests\Builder;

use League\Event\GeneratorInterface;

/**
 * @package tests\Builder
 */
interface TestBuilder
{
    /**
     * @return GeneratorInterface
     */
    public function build() : GeneratorInterface;
}
