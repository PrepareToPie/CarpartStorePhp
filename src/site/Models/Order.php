<?php


namespace ilsur\Models;


use DbClass;

class Order
{
    public static function addOrder($data)
    {
        $action = new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin");
        var_dump($data['order_placed']);
        if (!empty($data['address_line2'])) {
            $action->execute("
                INSERT INTO order_items(user_id, first_name, last_name, address_line1, address_line2, zip_code, city, state, country, phone_number, order_placed, order_total)
                VALUES (:user_id, :first_name, :last_name, :address_line1, :address_line2, :zip_code, :city, :state, :country, :phone_number, :order_placed, :order_total)
                ",
                array(
                    ':user_id' => $data['user_id'],
                    ':first_name' => $data['first_name'],
                    ':last_name' => $data['last_name'],
                    ':address_line1' => $data['address_line1'],
                    ':address_line2' => $data['address_line2'],
                    ':zip_code' => $data['zip_code'],
                    ':city' => $data['city'],
                    ':state' => $data['state'],
                    ':country' => $data['country'],
                    ':phone_number' => $data['phone_number'],
                    ':order_placed' => $data['order_placed'],
                    ':order_total' => $data['order_total']
                ));
        } else {
            $action->execute("
                INSERT INTO order_items(user_id, first_name, last_name, address_line1, zip_code, city, state, country, phone_number, order_placed, order_total)
                VALUES (:user_id, :first_name, :last_name, :address_line1, :zip_code, :city, :state, :country, :phone_number, :order_placed, :order_total)
                ",
                array(
                    ':user_id' => $data['user_id'],
                    ':first_name' => $data['first_name'],
                    ':last_name' => $data['last_name'],
                    ':address_line1' => $data['address_line1'],
                    ':zip_code' => $data['zip_code'],
                    ':city' => $data['city'],
                    ':state' => $data['state'],
                    ':country' => $data['country'],
                    ':phone_number' => $data['phone_number'],
                    ':order_placed' => $data['order_placed'],
                    ':order_total' => $data['order_total']
                ));
        }
        $order_id = $action->lastInsertId();
        //var_dump($_SESSION['cart_item']);
        foreach ($_SESSION['cart_item'] as $item) {
            $action->execute("
                    INSERT INTO order_details(order_id, carpart_id, amount)
                    VALUES (:order_id, :carpart_id, :amount)",
                array(
                    ':order_id' => $order_id,
                    ':carpart_id' => $item['id'],
                    ':amount' => $item['quantity'],
                ));
        }
    }

    public static function getOrderDataByUserId($user_id)
    {
        $db = new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin");
        $result = $db->query("SELECT * FROM order_items WHERE user_id = :user_id",
            array(
                ':user_id' => $user_id
            ));
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['items'] = $db->query("SELECT carpart_id, amount FROM order_details WHERE order_id = :order_id",
                array(
                    ':order_id' => $result[$i]['id']
                ));
        }
        for ($i = 0; $i < count($result); $i++) {
            for ($j = 0; $j < count($result[$i]['items']); $j++) {
                $result[$i]['items'][$j] = array_merge($result[$i]['items'][$j], $db->query("SELECT name, manufacturer, price FROM carpart WHERE id = :carpart_id",
                    array(
                        ':carpart_id' => $result[$i]['items'][$j]['carpart_id']
                    ))[0]);
            }
        }
        return $result;
    }
    public static function deleteOrder($order_id){
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))
            ->execute("DELETE FROM order_items WHERE id = :id",
                array(
                    ':id' => strval($order_id)
                ));
    }
}