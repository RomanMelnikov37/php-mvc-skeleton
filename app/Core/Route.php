<?php

namespace App\Core;

class Route
{
    private static array $routesGet = [];
    private static array $routesPost = [];

    /**
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    /**
     * @return array
     */
    public static function getRoutesPost(): array
    {
        return self::$routesPost;
    }

    public static function get(string $route, array $controller): RouteConfig
    {
        $routeConfig = new RouteConfig($route, $controller[0], $controller[1]);
        self::$routesGet[] = $routeConfig;

        return $routeConfig;
    }

    public static function post(string $route, array $controller): RouteConfig
    {
        $routeConfig = new RouteConfig($route, $controller[0], $controller[1]);
        self::$routesPost[] = $routeConfig;

        return $routeConfig;
    }

    public static function redirect($url): void
    {
        header("Location: $url");
    }
}