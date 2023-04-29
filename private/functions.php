<?php

use JetBrains\PhpStorm\NoReturn;

function urlFor($script_path): string
{
    // add the leading '/' if not present
    if($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function encodeUrl($string=""): string
{
    return urlencode($string);
}

function encodeRawUrl($string=""): string
{
    return rawurlencode($string);
}

function removeSpecialChars($string=""): string
{
    return htmlspecialchars($string);
}

function error404(): void
{
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}

function error500(): void
{
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}

function redirectTo($location): void
{
    header("Location: " . $location);
    exit;
}

function isPostRequest(): bool
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function isGetRequest(): bool
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// PHP on Windows does not have a money_format() function.
// This is a super-simple replacement.
if(!function_exists('money_format')) {
    function money_format($format, $number): string
    {
        return '$' . number_format($number, 2);
    }
}
