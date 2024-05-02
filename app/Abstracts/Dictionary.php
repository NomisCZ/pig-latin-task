<?php

namespace App\Abstracts;

use App\Contracts\DictionaryInterface;

abstract class Dictionary implements DictionaryInterface
{
    /**
     * @var array<string, mixed>
     */
    protected array $dictionary = [];

    public function __construct(
        private readonly string $filePath,
    ) {
        $this->loadData();
    }

    public function loadData(): void
    {
        $data = file_get_contents($this->filePath);

        $jsonData = json_decode($data, true);

        if ($jsonData === null) {
            throw new \RuntimeException('Failed to parse JSON data');
        }

        $this->dictionary = $jsonData;
    }

    public function hasWord(string $word): bool
    {
        return array_key_exists($word, $this->dictionary);
    }

    abstract function findWord(string $word): mixed;
}
