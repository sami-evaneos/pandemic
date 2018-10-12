<?php

namespace Pandemic\Domain\Common;

/**
 * @package Pandemic\Domain\Common
 */
interface Id
{
    /**
     * {@inheritDoc}
     */
    public function __toString();

    /**
     * @param  Id $anotherId
     *
     * @return bool
     */
    public function equals(Id $anotherId);
}
