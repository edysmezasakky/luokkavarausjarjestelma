<?php

$finder = PhpCsFixer\Finder::create()
  ->in(__DIR__)
  ->exclude('var') // exclude cache/temp folders if you have them
;

$config = new PhpCsFixer\Config();
return $config->setRules([
  '@PSR12' => true,
  'array_syntax' => ['syntax' => 'short'], // Force [] instead of array()
  'no_unused_imports' => true, // Remove unused 'use' statements
  'trailing_comma_in_multiline' => true, // Add commas in lists (better for git diffs)
])
  ->setFinder($finder);
