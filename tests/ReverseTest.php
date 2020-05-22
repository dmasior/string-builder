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
        $builder = new Builder('ウィキペディア');

        $this->assertSame('アィデペキィウ', $builder->reverse()->toString());
    }
}
