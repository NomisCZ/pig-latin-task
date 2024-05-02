<?php

namespace App\Services\PigLatinTranslator;

use App\Contracts\WordInterface;

class Word implements WordInterface
{
    public const REGEX_VOWEL = '/^([aeiou]+)(.*)/i';
    public const REGEX_CONSONANT = '/^([^aeiou]+)(.*)/i';

    public const SUFFIX_AY = 'ay';
    public const SUFFIX_HAY = 'hay';
    public const SUFFIX_WAY = 'way';
    public const SUFFIX_YAY = 'yay';

    public function __construct(
        private readonly string              $word,
        private readonly ?CompoundDictionary $compoundDictionary = null,
        private readonly string              $suffix = self::SUFFIX_AY,
        private readonly string              $delimiter = '',
    ) {
    }

    public function process(): string
    {
        $word = strtolower($this->word);

        if ($result = $this->processDashSeparatedWord($word)) {
            return $result;
        }

        if ($result = $this->processCompoundWord($word)) {
            return $result;
        }

        return $this->processSimpleWord($word);
    }

    public function __toString(): string
    {
        return $this->process();
    }

    /**
     * Process a simple word.
     */
    private function processSimpleWord(string $word): string
    {
        return match (1) {
            preg_match(self::REGEX_VOWEL, $word, $matches) => $matches[1] . $matches[2] . $this->delimiter . self::SUFFIX_YAY,
            preg_match(self::REGEX_CONSONANT, $word, $matches) => $matches[2] . $this->delimiter . $matches[1] . $this->suffix,
            default => $word,
        };
    }

    /**
     * Process a dash-separated word.
     */
    private function processDashSeparatedWord(string $word):? string
    {
        if (!str_contains($word, '-')) {
            return null;
        }

        $subWords = explode('-', $word);
        $translatedWords = $this->processWordCollection($subWords);

        return implode('-', $translatedWords);
    }

    /**
     * Process a compound word.
     */
    private function processCompoundWord(string $word):? string
    {
        $subWords = $this->compoundDictionary?->findWord($word);

        if ($subWords === null) {
            return null;
        }

        $translatedWords = $this->processWordCollection($subWords);

        return implode('', $translatedWords);
    }

    /**
     * Process a collection of words.
     */
    private function processWordCollection(array $words): array
    {
        return array_map(fn (string $word) => (new self($word, $this->compoundDictionary, $this->suffix, $this->delimiter))->process(), $words);
    }
}
