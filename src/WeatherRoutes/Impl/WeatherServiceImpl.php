<?php

namespace WeatherRoutes\Impl;

use Carbon\Carbon;
use WeatherRoutes\Api\WeatherService;
use WebX\Db\Db;
use WebX\Db\DbException;

class WeatherServiceImpl implements WeatherService{

    private $db;
    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function current()
    {
        $inside = null;
        $outside = null;
        $timestamp = null;
        try{
            if($row = $this->db->firstRow("select inTemp, outTemp, dateTime from archive order by dateTime desc")){
                $inside =  $this->fahrenheitToCelcius($row->float("inTemp"));
                $outside = $this->fahrenheitToCelcius($row->float("outTemp"));
                $timestamp = Carbon::createFromTimestamp($row->int("dateTime"));

            }   
        } catch(DbException $e){
            var_dump($e);
        }

        return [
            "inside" => $inside,
            "outside" => $outside,
            "timestamp" => $timestamp,
            "humanTimestamp" => $timestamp->diffForHumans()
        ];
    }

    private function fahrenheitToCelcius($value){
        return (5/9*($value-32));
    }
}