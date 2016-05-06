<?php

namespace WeatherRoutes\Impl;

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
        try{
            if($row = $this->db->firstRow("select * from archive_day_inTemp order by dateTime desc")){
                return $this->fahrenheitToCelcius($row->float("min"));
            }   
        } catch(DbException $e){
            var_dump($e);
        }
    }

    private function fahrenheitToCelcius($value){
        return (5/9*($value-32));
    }
}