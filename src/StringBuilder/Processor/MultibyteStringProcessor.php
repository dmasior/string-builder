<?php

declare(strict_types=1);

namespace Dmasior\StringBuilder\Processor;

use function mb_strlen;
use function mb_strpos;
use function mb_strrpos;
use function mb_substr;

class MultibyteStringProcessor implements StringProcessorInterface
{
    public function strLen(string $str): int
    {
        return mb_strlen($str);
    }

    public function subStr(string $str, int $start, ?int $len = null): string
    {
        return mb_substr($str, $start, $len);
    }

    public function strPos(string $haystack, string $needle, int $fromIndex): int
    {
        $pos = mb_strpos($haystack, $needle, $fromIndex);

        return $pos !== false ? $pos : -1;
    }

    public function strRevPos(string $haystack, string $needle, int $fromIndex): int
    {
        $pos = mb_strrpos($haystack, $needle, $fromIndex);

        return $pos !== false ? $pos : -1;
    }
}
