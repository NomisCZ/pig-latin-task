<?php

namespace Tests;

use App\Services\PigLatinTranslator\CompoundDictionary;
use App\Services\PigLatinTranslator\PigLatinTranslator;
use PHPUnit\Framework\TestCase;

final class PigLatinTranslatorCompoundDictionaryTest extends TestCase
{
    private PigLatinTranslator $translator;

    public function setUp(): void
    {
        $this->translator = new PigLatinTranslator;
        $this->translator->useCompoundDictionary(new CompoundDictionary(__DIR__ . '/../storage/dictionary.json'));
    }

    public function testKnownWords(): void
    {
        $this->assertEquals('irefayackercray', $this->translator->translate('firecracker'));
        $this->assertEquals('eyewayightsay', $this->translator->translate('eyesight'));
    }

    public function testUnknownWords(): void
    {
        $this->assertEquals('eadsethay', $this->translator->translate('headset'));
    }
}
