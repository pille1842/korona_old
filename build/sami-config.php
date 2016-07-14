<?php

use Sami\Sami;
use Sami\Parser\Filter\TrueFilter;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . '/../app');

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
