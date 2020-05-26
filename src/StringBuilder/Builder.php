<?php

declare(strict_types=1);

namespace Dmasior\StringBuilder;

use Dmasior\StringBuilder\Exception\IndexOutOfBoundsException;
use Dmasior\StringBuilder\Exception\StringIndexOutOfBoundsException;
use Dmasior\StringBuilder\Processor\MultibyteStringProcessor;
use Dmasior\StringBuilder\Processor\NonMultibyteStringProcessor;
use Dmasior\StringBuilder\Processor\StringProcessorInterface;

class Builder
{
    /**
     * @var string
     */
    private $str = '';

    /**
     * @var int
     */
    private $length = 0;

    /**
     * @var bool
     */
    private $lengthInvalidated = false;

    /**
     * @var StringProcessorInterface
     */
    private $processor;

    /**
     * @param string|mixed $str
     * @param StringProcessorInterface|null $processor
     */
    public function __construct($str = '', ?StringProcessorInterface $processor = null)
    {
        if ($processor === null) {
            if (extension_loaded('mbstring')) {
                $processor = new MultibyteStringProcessor();
            } else {
                $processor = new NonMultibyteStringProcessor();
            }
        }
        $this->processor = $processor;
        $this->insert(0, $str);
    }

    /**
     * @param string|mixed $str
     * @param StringProcessorInterface|null $processor
     * @return self
     */
    public static function create($str = '', ?StringProcessorInterface $processor = null): self
    {
        return new self($str, $processor);
    }

    /**
     * @param string|mixed $str
     * @param int|null $start
     * @param int|null $end
     * @return self
     */
    public function append($str, ?int $start = null, ?int $end = null): self
    {
        $this->insert($this->length(), $str, $start, $end);

        return $this;
    }

    /**
     * @param int $offset
     * @param string|mixed $str
     * @param int|null $start
     * @param int|null $end
     * @return self
     */
    public function insert(int $offset, $str, ?int $start = null, ?int $end = null): self
    {
        $start = $start ?? 0;

        if ($start < 0) {
            throw new IndexOutOfBoundsException('Start must not be negative');
        }

        $len = null;

        if ($end !== null) {
            $len = $end - $start;
        }

        if ($start > $end) {
            throw new IndexOutOfBoundsException('Start must not be greater than end');
        }

        $str = (string)$str;

        if ($end > $this->processor->strLen($str)) {
            throw new IndexOutOfBoundsException('End must not be greater than str length');
        }

        $str = $this->processor->substr($str, $start, $len);

        $pre = $this->processor->substr($this->str, 0, $offset);
        $post = $this->processor->substr($this->str, $offset);

        $this->str = $pre . $str . $post;

        $this->lengthInvalidated = true;

        return $this;
    }

    public function toString(): string
    {
        return $this->str;
    }

    /**
     * @param string|mixed $str
     * @param int $fromIndex
     * @return int
     */
    public function lastIndexOf($str, int $fromIndex = 0): int
    {
        return $this->processor->strRevPos($this->str, (string)$str, $fromIndex);
    }

    /**
     * @param string|mixed $str
     * @param int $fromIndex
     * @return int
     */
    public function indexOf($str, int $fromIndex = 0): int
    {
        return $this->processor->strPos($this->str, (string)$str, $fromIndex);
    }

    public function reverse(): self
    {
        $length = $this->length();
        $reversed = '';

        while ($length) {
            --$length;
            $reversed .= $this->charAt($length);
        }

        $this->str = $reversed;

        return $this;
    }

    public function length(): int
    {
        if ($this->lengthInvalidated) {
            $this->length = $this->processor->strLen($this->str);
            $this->lengthInvalidated = false;
        }

        return $this->length;
    }

    public function substring(int $start, int $end): string
    {
        $len = $this->length();

        if ($start < 0) {
            throw new IndexOutOfBoundsException('Start must not be negative');
        }
        if ($end < 0) {
            throw new IndexOutOfBoundsException('End must not be negative');
        }
        if ($start > $len) {
            throw new IndexOutOfBoundsException('Start must not be greater than length');
        }
        if ($end > $len) {
            throw new IndexOutOfBoundsException('End must not be greater than length');
        }
        if ($start > $end) {
            throw new IndexOutOfBoundsException('Start must not be greater than end');
        }

        return $this->processor->substr($this->str, $start, $end - $start);
    }

    public function charAt(int $index): string
    {
        if ($index >= $this->length()) {
            throw new IndexOutOfBoundsException('Index must be lower than length');
        }

        return $this->processor->substr($this->str, $index, 1);
    }

    public function delete(int $start, int $end): self
    {
        if ($start < 0) {
            throw new StringIndexOutOfBoundsException('Start must not be negative');
        }

        if ($start > $this->length()) {
            throw new StringIndexOutOfBoundsException('Start must not be greater than length');
        }

        if ($start > $end) {
            throw new StringIndexOutOfBoundsException('Start must not be greater than end');
        }

        $pre = $this->processor->substr($this->str, 0, $start - 1);
        $post = $this->processor->substr($this->str, $end);

        $this->str = $pre . $post;

        $this->lengthInvalidated = true;

        return $this;
    }

    public function deleteCharAt(int $index): self
    {
        $this->delete($index, $index);

        return $this;
    }
}
