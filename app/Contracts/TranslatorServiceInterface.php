<?php

namespace App\Contracts;

interface TranslatorServiceInterface
{
    /**
     * Translate the input string.
     */
    public function translate(string $input): string;
}
