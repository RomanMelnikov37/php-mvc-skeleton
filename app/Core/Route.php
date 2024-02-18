<?php

namespace App\Core;

class Route
{
    private static array $routesGet = [];

    /**
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    public static function get(string $route, array $controller): RouteConfig
    {
        $routeConfig = new RouteConfig($route, $controller[0], $controller[1]);
        self::$routesGet[] = $routeConfig;

        return $routeConfig;
    }
}