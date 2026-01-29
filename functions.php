<?php declare(strict_types=1);

function base_path($path)
{
    require BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require 'views/' . $path;
}

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function oldUserIput($key1, $key2)
{
    return \Core\Session::get($key1)[$key2] ?? '';
}

?>