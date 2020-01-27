<?php


namespace ilsur\Controller;


use ilsur\Models\Order;

class OrderController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public static function actionOrderCreate()
    {
        if (!empty($_SESSION['user'])) {
            return (new \CoreClass)->createResponse(['view' => 'order/checkout'], 200);
        } else {
            return (new \CoreClass)->createResponse(['view' => 'shopcart/list'], 200);
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public static function actionOrderCheckout()
    {
        $data = $_POST;
        $data['order_placed'] = date('y-m-d H:i:s');
        $data['order_total'] = $_SESSION['total'];
        $data['user_id'] = $_SESSION['user']['0']['id'];
        empty($_POST['email']) ? $data['email'] = $_SESSION['user']['0']['email'] : $data['email'] = $_POST['email'];
        Order::addOrder($data);
        unset($_SESSION['cart_item']);
        return (new \CoreClass)->createResponse(['view' => 'order/complete'], 200);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public static function actionOrderList()
    {
        $orders = Order::getOrderDataByUserId($_SESSION['user']['0']['id']);
        return (new \CoreClass)->createResponse(['view' => 'order/list', 'data' => [
            'orders' => $orders
        ]]);
    }
}