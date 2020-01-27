<?php


namespace ilsur\Models;


use DbClass;

class Shopcart
{
    public static function getShopcart($shopcartId)
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->dbFind('shopcart', $shopcartId);
    }

    public static function addToShopcart($item_id)
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->execute("
                INSERT INTO shopcartitem(carpart_id)
                VALUES (:carpart_id)
                INSERT INTO shopcart (item_id)
                VALUES (:item_id);",
                array(
                    ':item_id' => strval($item_id),
                    ':carpart_id' => $item_id
                ));
    }

    public static function removeFromShopcart($item_id)
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->execute("DELETE FROM shopcart WHERE item_id = :item_id",
                array(
                    ':item_id' => strval($item_id)
                ));
    }

    public static function getShopcartItems()
    {
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->execute("SELECT carpart.id FROM shopcart, shopcartitem
                JOIN carpart ON carpart.id = shopcartitem.carpart_id
                WHERE shopcartitem.id = shopcart.item_id");
    }

    public static function clearShopcart()
    {
//        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
//            ->execute("DELETE * FROM shopcart WHERE shopcart.id = ");
    }
}