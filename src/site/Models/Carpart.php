<?php


namespace ilsur\Models;


use DbClass;

class Carpart
{
    /**
     * @param null $category
     * @return array|mixed
     */
    public static function getCarpartList($category = null)
    {
        if ($category) {
            if ($category == 'in_stock') {
                return self::getCarpartListInStock();
            }
            else
                return self::getCarpartListByCategory($category);
        }
        else {
            return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
                ->dbSelectAll('carpart');
        }
    }

    /**
     * @param $carpartName
     * @return mixed
     */
    public static function getCarpartIdByName($carpartName)
    {
        $result = (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->query("SELECT id FROM carpart WHERE name = :name",
                array(
                    ':name' => $carpartName
                ));
        return $result[0];
    }

    /**
     * @param $carpartId
     * @return array
     */
    public static function getCarpartById($carpartId)
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->dbFind('carpart', $carpartId);
    }

    /**
     * @param $category_id
     * @return mixed
     */
    private static function getCarpartListByCategory($category_id)
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->query("SELECT * FROM carpart WHERE carpart.category_id = :category_id",
                array(
                    ':category_id' => strval($category_id)
                ));
    }

    /**
     * @return mixed
     */
    private static function getCarpartListInStock()
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->query("SELECT * FROM carpart WHERE carpart.in_stock > 0");
    }

    public static function getCarpartListByVin($vin)
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->query("SELECT * FROM carpart WHERE carpart.car_vin = :vin",
                array(
                    ':vin' => strval($vin)
                ));
    }

}