<body>
<div class="col-lg-8 mx-auto row checkoutForm py-5">
    <h2 class="text-center">Ваша корзина <?php
        if (empty($_SESSION['cart_item'])) {
            echo 'пуста';
        }
        else{
            if (!empty($_GET)) {
                if ($_GET["action"] == "remove") {
                    if (!empty($_SESSION["cart_item"])) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($_GET["id"] == $k)
                                unset($_SESSION["cart_item"][$k]);
                            if (empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                            header( "Location: shopcart/list.php" );
                        }
                    }
                }
                if ($_GET["action"] == "empty") {
                    unset($_SESSION["cart_item"]);
                    header( "Location: shopcart/list.php" );
                }
            }
        ?>
    </h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th>Выбранное количество</th>
            <th>Деталь</th>
            <th class="text-right">Цена</th>
            <th class="text-right">Пром итог</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($_SESSION['cart_item'])){
        $total = 0;
        foreach ($_SESSION['cart_item'] as $item) {
            ?>
            <tr>
                <td class="text-center"><?php echo $item['quantity'] ?></td>
                <td class="text-left"><?php echo $item['name'] ?></td>
                <td class="text-right"><?php echo $item['price'] ?></td>
                <td class="text-right">
                    <?php echo($item['quantity'] * $item['price']);
                    $total += $item['quantity'] * $item['price']; ?>
                <td class="text-center"><a class="fa fa-trash text-danger remove"
                                           href="/shopcart/list?action=remove&id=<?php echo $item["id"]; ?>">
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" class="text-right">Итого к оплате:</td>
            <td class="text-right">
                <?php echo $total;
                $_SESSION['total'] = $total; ?>
            </td>
        </tr>
        </tfoot>
    </table>

    <div class="text-right">
        <div class="btn-group ">
            <a class="btn btn-success" href="/order/create">Оформить заказ</a>
            <a class="btn btn-primary" href="/carpart/list/">Вернуться к товарам</a>
            <a class="btn btn-danger" href="/shopcart/list?action=empty">Очистить корзину</a>
        </div>
    </div>
    <?php
    if (empty($_SESSION['user'])) {
        ?>
        <p class="text-danger text-left">Для оформления заказа зарегестрируйтесь или войдите в личный профиль!</p>
    <?php }
    }
    } ?>
</div>
</body>