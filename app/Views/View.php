<?php

namespace App\Views;

class View
{
    private static string $path;
    private static ?array $data;

    public static function view(string $path, array $data = []): string
    {
        self::$data = $data;
        self::$path = ROOT . 'resources/views' . str_replace('.', '/', $path) . '.php';

        return self::getContent();
    }

    private static function getContent(): string
    {
        extract(self::$data);
        ob_start();
        include self::$path;

        return ob_get_clean();
    }
}