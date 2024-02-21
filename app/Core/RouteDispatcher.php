<?php

namespace App\Core;

class RouteDispatcher
{
    private string $requestUri = '/';
    private array  $paramMap   = [];
    private array  $paramRequestMap   = [];

    /**
     * @param RouteConfig $routeConfig
     */
    public function __construct(private RouteConfig $routeConfig)
    {
    }

    public function process(): void
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    /**
     * Чистим строку роута
     *
     * @return void
     */
    private function saveRequestUri(): void
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri         = $this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfig->route = $this->clean($this->routeConfig->route);
        }
    }

    private function clean(string $str): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }

    /**
     * Разбиваем строку роута на массив и сохраняем в новый массив позицию параметр и его название
     *
     * @return void
     */
    public function setParamMap(): void
    {
        $routeArray = explode('/', $this->routeConfig->route);
        foreach ($routeArray as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }
    }

    /**
     * Разбиваем строку запроса на массив и проверяем есть ли в этом массиве позиция, как у позиции параметра,
     * если есть такая позиция, значит приводим строку запроса в регулярное выражение
     *
     * @return void
     */
    private function makeRegexRequest(): void
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }

            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }

        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
    }

    private function prepareRegex(): void
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function run(): void
    {
        if (preg_match("/$this->requestUri/", $this->routeConfig->route)) {
            $this->render();
        }
    }

    private function render(): void
    {
        $ClassName = $this->routeConfig->controller;
        $action = $this->routeConfig->action;

        $content = (new $ClassName)->$action(...$this->paramRequestMap);
        echo $content; // todo add Response
        die;
    }
}
