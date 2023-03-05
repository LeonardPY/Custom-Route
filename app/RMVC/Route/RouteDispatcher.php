<?php

namespace App\RMVC\Route;

class RouteDispatcher
{
    private string $requesUri = "/";

    private array $paramMap = [];
    private array $paramRequestMap = [];

    private RouteConfiguration $routeConfiguration;

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }


    public function process()
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    public function saveRequestUri()
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requesUri = $this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->clean($this->routeConfiguration->route);
        }

    }

    public function clean($str): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }

    public function setParamMap()
    {
        $routeArr = explode('/', $this->routeConfiguration->route);

        foreach ($routeArr as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }
    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requesUri);

        foreach ($this->paramMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }
            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }
        $this->requesUri = implode('/', $requestUriArray);
        $this->preapareRegex();
    }

    private function preapareRegex()
    {
        $this->requesUri = str_replace('/', '\/', $this->requesUri);
    }

    private function run()
    {
        if (preg_match("/$this->requesUri/", $this->routeConfiguration->route)) {
            $this->render();
        }
    }

    private function render()
    {
        $ClassName = $this->routeConfiguration->controller;
        $action = $this->routeConfiguration->action;
        print((new $ClassName)->$action(...$this->paramRequestMap));
        die();
    }
}