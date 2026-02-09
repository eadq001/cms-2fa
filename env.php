<?php declare(strict_types=1);

// var_dump(getcwd());

$lines = file( BASE_PATH . '.env', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

foreach ($lines as $line) {
    if (str_starts_with(trim($line), '#'))
        continue;

    [$key, $value] = explode('=', $line, 2);

    // putenv(trim($key) . '=' . trim($value));
    $_ENV[trim($key)] = trim($value);
}

?>