<?php

namespace App\Core;

class App
{
    public static function run()
    {
        foreach (Route::getRoutesGet() as $routeConfig) {
            $routeDispatcher = new RouteDispatcher($routeConfig);
            $routeDispatcher->process();
        }
    }
}