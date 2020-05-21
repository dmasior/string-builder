<?php declare(strict_types=1);

namespace Initx\Tests;

use Initx\StringBuilder\Builder;
use Initx\StringBuilder\Exception\IndexOutOfBoundsException;
use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    /**
     * @test
     */
    public function lastIndexOf(): void
    {
        $builder = new Builder('123abc123abc');

        $lastIndex = $builder->lastIndexOf('123');

        $this->assertSame(6, $lastIndex);
    }

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
    public function length(): void
    {
        $builder = new Builder('1234567890');

        $this->assertSame(10, $builder->length());
    }

    /**
     * @test
     */
    public function substring(): void
    {
        $builder = new Builder('1234567890');

        $this->assertSame('345678', $builder->substring(2, 8));
    }

    /**
     * @test
     */
    public function substringNegativeStartThrows(): void
    {
        $builder = new Builder('1');

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('Start must not be negative');

        $builder->substring(-1, 8);
    }

    /**
     * @test
     */
    public function substringNegativeEndThrows(): void
    {
        $builder = new Builder('1');

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('End must not be negative');

        $builder->substring(1, -1);
    }

    /**
     * @test
     */
    public function substringStartMustNotBeGreaterThanLength(): void
    {
        $builder = new Builder('1');

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('Start must not be greater than length');

        $builder->substring(2, 3);
    }

    /**
     * @test
     */
    public function substringEndMustNotBeGreaterThanLength(): void
    {
        $builder = new Builder('1');

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('End must not be greater than length');

        $builder->substring(1, 2);
    }

    /**
     * @test
     */
    public function substringStartMustNotBeGreaterThanEnd(): void
    {
        $builder = new Builder('123');

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('Start must not be greater than end');

        $builder->substring(2, 1);
    }
}
