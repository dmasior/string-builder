<?php declare(strict_types=1);

namespace Dmasior\Tests;

use Dmasior\StringBuilder\Builder;
use PHPUnit\Framework\TestCase;

class ReverseTest extends TestCase
{
    /**
     * @test
     */
    public function reverse(): void
    {
        $builder = new Builder('12345ABC');

        $builder->reverse();

        $this->assertSame('CBA54321', $builder->toString());
    }

    /**
     * @test
     */
    public function reverseIsMultiByteSafe(): void
    {
        $builder = new Builder('ウィキペディア');

        $this->assertSame('アィデペキィウ', $builder->reverse()->toString());
    }
}
