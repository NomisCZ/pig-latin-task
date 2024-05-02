<?php

namespace Tests;

use App\Services\PigLatinTranslator\PigLatinTranslator;
use PHPUnit\Framework\TestCase;

final class PigLatinTranslatorTest extends TestCase
{
    private PigLatinTranslator $translator;

    public function setUp(): void
    {
        $this->translator = new PigLatinTranslator;
    }

    public function testVowels(): void
    {
        $this->assertEquals('appleyay', $this->translator->translate('apple'));
        $this->assertEquals('orangeyay', $this->translator->translate('orange'));
    }

    public function testConsonants(): void
    {
        $this->assertEquals('ellohay', $this->translator->translate('hello'));
        $this->assertEquals('orldway', $this->translator->translate('world'));
    }

    public function testConsonantClusters(): void
    {
        $this->assertEquals('eethray', $this->translator->translate('three'));
        $this->assertEquals('eepslay', $this->translator->translate('sleep'));
    }

    public function testWordsWithHyphens(): void
    {
        $this->assertEquals('ellway-ownknay', $this->translator->translate('well-known'));
        $this->assertEquals('othermay-inyay-awlay', $this->translator->translate('mother-in-law'));
    }

    public function testCompoundWords(): void
    {
        $this->assertEquals('irecrackerfay', $this->translator->translate('firecracker'));
    }
}
