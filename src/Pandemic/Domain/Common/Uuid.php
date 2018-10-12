<?php

namespace Pandemic\Domain\Common;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid as ThirdPartyUuid;

/**
 * @abstract
 * @package Pandemic\Domain\Common
 */
abstract class Uuid implements Id
{
    /**
     * @var UuidInterface
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param  UuidInterface $value
     *
     * @return void
     */
    private function __construct(UuidInterface $value)
    {
        $this->value = $value;
    }

    /**
     * @param  UuidInterface $id
     *
     * @return static
     */
    public static function fromUuid(UuidInterface $id) : self
    {
        return new static($id);
    }

    /**
     * @param  $id
     *
     * @return static
     */
    public static function fromString($id) : self
    {
        return new static(ThirdPartyUuid::fromString($id));
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->value;
    }

    /**
     * @param  Id $anotherId
     *
     * @return bool
     */
    public function equals(Id $anotherId) : bool
    {
        return $this->__toString() === $anotherId->__toString();
    }
}
