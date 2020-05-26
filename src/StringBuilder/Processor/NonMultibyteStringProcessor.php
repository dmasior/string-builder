<?php

declare(strict_types=1);

namespace Dmasior\StringBuilder\Processor;

use function strlen;
use function strpos;
use function strrpos;
use function substr;

class NonMultibyteStringProcessor implements StringProcessorInterface
{
    public function strLen(string $str): int
    {
        return strlen($str);
    }

    public function subStr(string $str, int $start, ?int $len = null): string
    {
        if ($len !== null) {
            return substr($str, $start, $len) ?: '';
        }

        return substr($str, $start) ?: '';
    }

    public function strPos(string $haystack, string $needle, int $fromIndex): int
    {
        $pos = strpos($haystack, $needle, $fromIndex);

        return $pos !== false ? $pos : -1;
    }

    public function strRevPos(string $haystack, string $needle, int $fromIndex): int
    {
        $pos = strrpos($haystack, $needle, $fromIndex);

        return $pos !== false ? $pos : -1;
    }
}
