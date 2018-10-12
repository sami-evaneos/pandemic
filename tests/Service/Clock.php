<?php

namespace tests\Service;

/**
 * @package tests\Service
 */
class Clock
{
    /**
     * @return \DateTimeImmutable
     */
    public function now() : \DateTimeImmutable
    {
        return new \DateTimeImmutable('2018-10-31 00:00:00');
    }
}
