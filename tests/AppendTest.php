<?php

declare(strict_types=1);

namespace Dmasior\Tests;

use Dmasior\StringBuilder\Builder;
use PHPUnit\Framework\TestCase;

class AppendTest extends TestCase
{
    /**
     * @test
     */
    public function append(): void
    {
        $builder = new Builder();

        $builder->append('123');
        $builder->append(456);
        $builder->append('789');

        $this->assertSame('123456789', $builder->toString());
    }

    /**
     * @test
     */
    public function appendCodePoint(): void
    {
        $builder = new Builder();

        $builder->appendCodePoint(65);
        $builder->appendCodePoint(66);
        $builder->appendCodePoint(67);

        $this->assertSame('ABC', $builder->toString());
    }
}
