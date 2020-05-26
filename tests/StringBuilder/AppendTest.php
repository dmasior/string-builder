<?php

declare(strict_types=1);

namespace Dmasior\Tests\StringBuilder;

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
}
