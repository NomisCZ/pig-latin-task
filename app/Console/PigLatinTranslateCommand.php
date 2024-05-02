<?php

namespace App\Console;

use App\Services\PigLatinTranslator\CompoundDictionary;
use App\Services\PigLatinTranslator\PigLatinTranslator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:translate',
    description: 'Translate a string to Pig Latin'
)]
class PigLatinTranslateCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('value', InputArgument::REQUIRED, 'The string to translate to Pig Latin')
            ->addOption('useDictionary', 'ud', InputOption::VALUE_OPTIONAL, 'Use a dictionary to translate compound words', true);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $translator = new PigLatinTranslator;

        if ($input->getOption('useDictionary')) {
            $translator->useCompoundDictionary(new CompoundDictionary(__DIR__ . '/../../storage/dictionary.json'));
        }

        $output->writeln([
            'Translated:',
            '================',
            $translator->translate($input->getArgument('value')),
        ]);

        return Command::SUCCESS;
    }
}
