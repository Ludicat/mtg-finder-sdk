<?php
/**
 * Read and load .env file
 */
require_once realpath(__DIR__ . '/../vendor/autoload.php');
$env = parse_ini_file(__DIR__ . '/../.env');
// Override with .env.local
if (file_exists(__DIR__ . '/../.env.local')) {
    $env = array_merge($env, parse_ini_file(__DIR__ . '/../.env.local'));
}
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
    putenv("$key=$value");
}