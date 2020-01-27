<?php


namespace ilsur\Models;


use DbClass;

class Category
{
    public static function getCategory()
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->dbSelectAll("category");
    }
}