<?php

use App\Console\PigLatinTranslateCommand;
use App\Services\PigLatinTranslator\PigLatinTranslator;
use Symfony\Component\Console\Application;

$application = new Application();
// > Register console commands
$application->add(new PigLatinTranslateCommand());
// > Run the application
$application->run();
