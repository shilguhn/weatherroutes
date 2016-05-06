<?php

use WeatherRoutes\Api\WeatherService;
use WebX\Routes\Api\Response;
use WebX\Routes\Api\Routes;
use WebX\Routes\Api\RoutesBootstrap;

require_once "../vendor/autoload.php";

RoutesBootstrap::run([function(Routes $routes) {
    $routes->onAlways(function (Response $response, WeatherService $weatherService) {
        $response->data($weatherService->current(), "weather");
        $response->typeTemplate()->id("dashboard");
    });
},"default"]);