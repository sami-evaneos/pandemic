<?php

namespace spec\Pandemic\Domain\Common;

use Pandemic\Domain\Common\Id;
use Pandemic\Domain\Common\Uuid;
use PhpSpec\ObjectBehavior;
use tests\Pandemic\FakeUuid;

class UuidSpec extends ObjectBehavior
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->id = anUuidFactory()->uuid4();
    }

    public function let()
    {
        $this->beAnInstanceOf(FakeUuid::class);
        $this->beConstructedThrough('fromString', [(string) $this->id]);
        $this->beConstructedThrough('fromUuid', [$this->id]);
    }

    public function it_is_initializable()
    {
        $this->shouldImplement(Id::class);
        $this->shouldHaveType(Uuid::class);
    }

    public function it_has_a_string_representation()
    {
        $this->__toString()->shouldReturn((string) $this->id);
    }

    public function it_tests_equality()
    {
        $this->equals(FakeUuid::fromUuid(anUuidFactory()->uuid4()))->shouldReturn(false);
        $this->equals(FakeUuid::fromUuid($this->id))->shouldReturn(true);
    }
}
