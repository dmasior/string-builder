<?php

declare(strict_types=1);

namespace Dmasior\StringBuilder\Processor;

interface StringProcessorInterface
{
    public function strLen(string $str): int;

    public function subStr(string $str, int $start, ?int $len = null): string;

    public function strPos(string $haystack, string $needle, int $fromIndex): int;

    public function strRevPos(string $haystack, string $needle, int $fromIndex): int;
}
