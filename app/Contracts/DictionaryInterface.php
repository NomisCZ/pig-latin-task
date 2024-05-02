<?php

namespace App\Contracts;

interface DictionaryInterface
{
    /**
     * Load the data.
     */
    public function loadData(): void;

    /**
     * Check if the word exists.
     */
    public function hasWord(string $word): bool;

    /**
     * Find the word.
     */
    public function findWord(string $word): mixed;
}
