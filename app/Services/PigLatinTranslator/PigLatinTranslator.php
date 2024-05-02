<?php

namespace App\Services\PigLatinTranslator;

use App\Contracts\TranslatorServiceInterface;

final class PigLatinTranslator implements TranslatorServiceInterface
{
    private ?CompoundDictionary $compoundDictionary = null;

    public function __construct(
        private string $wordSuffix = Word::SUFFIX_AY,
        private string $wordDelimiter = '',
    ) {
    }

    /**
     * Set the word suffix.
     */
    public function setWordSuffix(string $wordSuffix): self
    {
        $this->wordSuffix = $wordSuffix;

        return $this;
    }

    /**
     * Set the word delimiter.
     */
    public function setWordDelimiter(string $wordDelimiter): self
    {
        $this->wordDelimiter = $wordDelimiter;

        return $this;
    }

    /**
     * Use a compound dictionary.
     */
    public function useCompoundDictionary(CompoundDictionary $compoundDictionary): self
    {
        $this->compoundDictionary = $compoundDictionary;

        return $this;
    }

    /**
     * Translate the input string.
     */
    public function translate(string $input): string
    {
        $words = explode(' ', $input);
        $translatedWords = array_map(fn (string $word) => (new Word($word, $this->compoundDictionary, $this->wordSuffix, $this->wordDelimiter))->process(), $words);

        return implode(' ', $translatedWords);
    }
}
