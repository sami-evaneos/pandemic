<?php

namespace Pandemic\Domain\Common;

/**
 * @package Pandemic\Domain\Common
 */
class Clock
{
    /**
     * @return \DateTimeImmutable
     */
    public function now() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
