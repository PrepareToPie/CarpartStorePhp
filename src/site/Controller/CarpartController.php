<?php


namespace ilsur\Controller;


use ilsur\Models\Carpart;
use mysql_xdevapi\Exception;

class CarpartController
{
    /**
     * @param null $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public static function actionCarpartList($category = null)
    {
        $carparts = Carpart::getCarpartList($category);
        return (new \CoreClass)->createResponse(['view' => 'carpart/list', 'data' => [
            'carparts' => $carparts
        ]]);
    }
    public static function actionCarpartSearch(){
        if (!empty($_POST['vin'])) {
            $carparts = Carpart::getCarpartListByVin($_POST['vin']);
            return (new \CoreClass)->createResponse(['view' => 'carpart/list', 'data' => [
                'carparts' => $carparts
            ]]);
        }
        else return self::actionCarpartList();
    }
}