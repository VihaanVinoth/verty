<?php
$env = [];

$envPath = realpath(__DIR__ . '/../.env');

if ($envPath === false) {
   die(".env file not found");
}

$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
	$line = trim($line);

	if ($line === '' || $line[0] === '#') continue;

	if (!str_contains($line, '=')) {
	   continue;
	}

	[$key, $value] = explode('=', $line, 2);

	$env[trim($key)] = trim($value);
}