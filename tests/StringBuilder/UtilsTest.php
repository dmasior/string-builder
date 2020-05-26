<?php

declare(strict_types=1);

namespace Dmasior\Tests\StringBuilder;

use Dmasior\StringBuilder\Builder;
use Dmasior\StringBuilder\Exception\IndexOutOfBoundsException;
use Dmasior\StringBuilder\Exception\StringIndexOutOfBoundsException;
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
        $builder = new Builder('0123456789');

        $this->assertSame('123', $builder->substring(1, 4));
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

    /**
     * @test
     */
    public function charAt(): void
    {
        $builder = new Builder('123');

        $this->assertSame('2', $builder->charAt(1));
    }

    /**
     * @test
     */
    public function charAtIndexMustBeLowerThanLength(): void
    {
        $builder = new Builder('123');

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('Index must be lower than length');

        $builder->charAt(3);
    }

    /**
     * @test
     */
    public function codePointAt(): void
    {
        $builder = new Builder('PHP');

        $this->assertSame(72, $builder->codePointAt(1));
    }

    /**
     * @test
     */
    public function codePointBefore(): void
    {
        $builder = new Builder('PHP');

        $this->assertSame(80, $builder->codePointBefore(1));
    }

    /**
     * @test
     */
    public function delete(): void
    {
        $builder = new Builder('1234567890');

        $builder->delete(1, 1);
        $builder->delete(5, 10);

        $this->assertSame('2345', $builder->toString());
    }

    /**
     * @test
     */
    public function deleteStartMustNotBeNegative(): void
    {
        $builder = new Builder('1234567890');

        $this->expectException(StringIndexOutOfBoundsException::class);
        $this->expectExceptionMessage('Start must not be negative');

        $builder->delete(-1, 1);
    }

    /**
     * @test
     */
    public function deleteStartMustNotBeGreaterThanLength(): void
    {
        $builder = new Builder('1234');

        $this->expectException(StringIndexOutOfBoundsException::class);
        $this->expectExceptionMessage('Start must not be greater than length');

        $builder->delete(5, 6);
    }

    /**
     * @test
     */
    public function deleteStartMustNotBeGreaterThanEnd(): void
    {
        $builder = new Builder('1234');

        $this->expectException(StringIndexOutOfBoundsException::class);
        $this->expectExceptionMessage('Start must not be greater than end');

        $builder->delete(3, 2);
    }

    /**
     * @test
     */
    public function deleteCharAt(): void
    {
        $builder = new Builder('12345');

        $builder->deleteCharAt(5);

        $this->assertSame('1234', $builder->toString());
    }

    /**
     * @test
     */
    public function indexOf(): void
    {
        $builder = new Builder('123abc123abc');

        $this->assertSame(0, $builder->indexOf('123'));
    }
}
