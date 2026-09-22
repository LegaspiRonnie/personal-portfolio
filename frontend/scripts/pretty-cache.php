<?php

$cacheFile = $argv[1] ?? '.php-cs-fixer.cache';

if (!is_file($cacheFile)) {
    fwrite(STDERR, "Cache file not found: {$cacheFile}\n");
    exit(1);
}

try {
    $contents = file_get_contents($cacheFile);
    $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} catch (JsonException | ValueError $exception) {
    fwrite(STDERR, "Unable to format {$cacheFile}: {$exception->getMessage()}\n");
    exit(1);
}
