<?php

namespace App\Contracts;

interface WordInterface
{
    /**
     * Process the word.
     */
    public function process(): string;

    /**
     * Convert the word to a string.
     */
    public function __toString(): string;
}
