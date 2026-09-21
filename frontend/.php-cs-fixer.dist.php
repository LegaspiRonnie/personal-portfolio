<?php

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__ . '/personal-portfolio',
        __DIR__ . '/projects',
        // Add other folders you want to format here
    ]);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER-CS' => true, // Uses the latest modern PHP coding standard
        'array_syntax' => ['syntax' => 'short'], // Forces [] instead of array()
        'ordered_imports' => ['sort_algorithm' => 'alpha'], // Alphabetizes use statements
    ])
    ->setFinder($finder);
