<?php

namespace App\Services\PigLatinTranslator;

use App\Abstracts\Dictionary;

class CompoundDictionary extends Dictionary
{
    function findWord(string $word): ?array
    {
        return $this->dictionary[$word] ?? null;
    }
}
