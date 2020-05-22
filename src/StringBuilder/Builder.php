<?php declare(strict_types=1);

namespace Dmasior\StringBuilder;

use Dmasior\StringBuilder\Exception\IndexOutOfBoundsException;
use Dmasior\StringBuilder\Exception\StringIndexOutOfBoundsException;
use IntlChar;
use function mb_strlen;
use function mb_substr;
use function strrev;

class Builder
{
    /**
     * @var string
     */
    private $str = '';

    /**
     * @param string|mixed $str
     */
    public function __construct($str = '')
    {
        $this->insert(0, $str);
    }

    /**
     * @param string|mixed $str
     * @return self
     */
    public function create($str = ''): self
    {
        return new self($str);
    }

    /**
     * @param mixed $str
     * @param int|null $start
     * @param int|null $end
     * @return self
     */
    public function append($str, ?int $start = null, ?int $end = null): self
    {
        $this->insert(mb_strlen($this->str), $str, $start, $end);

        return $this;
    }

    public function appendCodePoint(int $codePoint): self
    {
        $this->append(IntlChar::chr($codePoint));

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

        if ($end > mb_strlen($str)) {
            throw new IndexOutOfBoundsException('End must not be greater than str length');
        }

        $str = mb_substr($str, $start, $len);

        $pre = mb_substr($this->str, 0, $offset);
        $post = mb_substr($this->str, $offset);

        $this->str = $pre . $str . $post;

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
        $pos = mb_strrpos($this->str, (string)$str, $fromIndex);

        return $pos !== false ? $pos : -1;
    }

    /**
     * @param string|mixed $str
     * @param int $fromIndex
     * @return int
     */
    public function indexOf($str, int $fromIndex = 0): int
    {
        $pos = mb_strpos($this->str, (string)$str, $fromIndex);

        return $pos !== false ? $pos : -1;
    }

    public function reverse(): self
    {
        $length   = $this->length();
        $reversed = '';
        while ($length-- > 0) {
            $reversed .= mb_substr($this->str, $length, 1, );
        }

        $this->str = $reversed;

        return $this;
    }

    public function length(): int
    {
        return mb_strlen($this->str);
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

        return mb_substr($this->str, $start, $end - $start);
    }

    public function charAt(int $index): string
    {
        if ($index >= $this->length()) {
            throw new IndexOutOfBoundsException('Index must be lower than length');
        }

        return \mb_substr($this->str, $index, 1);
    }

    public function codePointAt(int $index): int
    {
        $char = $this->charAt($index);

        return IntlChar::ord($char);
    }

    public function codePointBefore(int $int): int
    {
        return $this->codePointAt($int - 1);
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

        $pre = mb_substr($this->str, 0, $start-1);
        $post = mb_substr($this->str, $end);

        $this->str = $pre . $post;

        return $this;
    }

    public function deleteCharAt(int $index): self
    {
        $this->delete($index, $index);

        return $this;
    }
}
