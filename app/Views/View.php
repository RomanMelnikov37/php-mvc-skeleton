<?php

namespace App\Views;

class View
{
    private static string $path;
    private static ?array $data;

    public static function view(string $path, array $data = []): string
    {
        self::$data = $data;
        self::$path = str_replace('.', '/', $path) . '.php';

        return self::render();
    }

    private static function getContent(): string
    {
        extract(self::$data);
        ob_start();
        include self::$path;

        return ob_get_clean();
    }

    private static function render(): string
    {
        $content = self::getContent();
        ob_start();
        include 'layouts/main.php';

        return ob_get_clean();
    }
}