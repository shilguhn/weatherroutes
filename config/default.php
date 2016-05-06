<?php


use WeatherRoutes\Impl\WeatherServiceImpl;

use WebX\Db\Impl\DbImpl;

return [
    "ioc" => [
        "register" => [
            [WeatherServiceImpl::class],
            [DbImpl::class,["parameters"=>["mysqlConfig" => ["user" => "USER", "password" => "PASSWORD", "database" => "weewx"]]]]
        ]
    ]
];