<?php

namespace App\Core;

class RouteConfig
{
    private string $name;

    public function __construct(
        public string $route,
        public string $controller,
        public string $action
    ) {
    }

    /**
     * @param string $name
     * @return RouteConfig
     */
    public function name(string $name): RouteConfig
    {
        $this->name = $name;
        return $this;
    }
}