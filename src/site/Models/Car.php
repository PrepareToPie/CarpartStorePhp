<?php


namespace ilsur\Models;

use CommonClass;
use DbClass;

class Car
{
    public static function getCarById($carId){
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->dbFind('car', $carId);
    }
}