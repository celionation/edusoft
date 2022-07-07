<?php

namespace core;

class Config
{
    private static array $config = [
        'version'               => '1.0.0',
        'name'                  => 'Laraton Framework',
    ];

    public static function get($key)
    {
        if (array_key_exists($key, $_ENV)) return $_ENV[$key];
        return array_key_exists($key, self::$config) ? self::$config[$key] : NULL;
    }
}