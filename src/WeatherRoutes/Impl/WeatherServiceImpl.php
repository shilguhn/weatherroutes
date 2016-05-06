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
        $inside = null;
        $outside = null;
        try{
            if($row = $this->db->firstRow("select * from archive_day_inTemp order by dateTime desc")){
                $inside =  $this->fahrenheitToCelcius($row->float("min"));
            }   
        } catch(DbException $e){
            var_dump($e);
        }

        try{
            if($row = $this->db->firstRow("select * from archive_day_outTemp order by dateTime desc")){
                $outside =  $this->fahrenheitToCelcius($row->float("min"));
            }
        } catch(DbException $e){
            return [null, null];
        }
        return [
            "inside" => $inside,
            "outside" => $outside
        ];
    }

    private function fahrenheitToCelcius($value){
        return (5/9*($value-32));
    }
}