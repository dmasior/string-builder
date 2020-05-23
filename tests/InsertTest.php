<?php

declare(strict_types=1);

namespace Dmasior\Tests;

use Dmasior\StringBuilder\Builder;
use Dmasior\StringBuilder\Exception\IndexOutOfBoundsException;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    /**
     * @test
     */
    public function insert(): void
    {
        $builder = new Builder();

        $builder->insert(0, '1234')
            ->insert(4, '5678');

        $this->assertSame('12345678', $builder->toString());
    }

    /**
     * @test
     */
    public function insertWithOffset(): void
    {
        $builder = new Builder('123');

        $builder->insert(2, '456');

        $this->assertSame('124563', $builder->toString());
    }

    /**
     * @test
     */
    public function insertWithStartEnd(): void
    {
        $builder = new Builder();

        $builder->insert(0, "12345678", 2, 5);

        $this->assertSame('345', $builder->toString());
    }

    /**
     * @test
     */
    public function insertWithStartEndSameReturnsEmptyString(): void
    {
        $builder = new Builder();

        $builder->insert(0, "12345678", 2, 2);

        $this->assertSame('', $builder->toString());
    }

    /**
     * @test
     */
    public function insertNegativeStartThrows(): void
    {
        $builder = new Builder();

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('Start must not be negative');

        $builder->insert(0, "1", -1);
    }

    /**
     * @test
     */
    public function insertStartGreaterThanEndThrows(): void
    {
        $builder = new Builder();

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('Start must not be greater than end');

        $builder->insert(0, "1", 3, 2);
    }

    /**
     * @test
     */
    public function insertEndGreaterThanLengthThrows(): void
    {
        $builder = new Builder();

        $this->expectException(IndexOutOfBoundsException::class);
        $this->expectDeprecationMessage('End must not be greater than str length');

        $builder->insert(0, "1", 1, 2);
    }
}
