<?php


namespace ilsur\Controller;


use ilsur\Models\Shopcart;

class ShopcartController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public static function actionShopcartList()
    {
        $items = Shopcart::getShopcartItems();
        return (new \CoreClass)->createResponse(['view' => 'shopcart/list', 'data' => [
            'items' => $items
        ]]);
    }

    /**
     * @param $item_id
     * @param $category
     */
    public static function actionShopcartAdd($item_id, $category)
    {
        Shopcart::addToShopcart($item_id);
        CarpartController::actionCarpartList($category);
    }

}