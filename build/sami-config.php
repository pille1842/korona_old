<?php

use Sami\Sami;
use Sami\Parser\Filter\TrueFilter;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('vendor')
    ->exclude('tests')
    ->exclude('storage')
    ->exclude('public')
    ->in(__DIR__ . '/..');

$sami = new Sami($iterator, array(
    'title' => 'Korona API-Dokumentation',
    'build_dir' => __DIR__ . '/../docs/api',
    'cache_dir' => __DIR__ . '/sami-cache',
    'default_opened_level' => 2,
));

$sami['filter'] = function () {
    return new TrueFilter();
};

return $sami;
