<body>
<div class="py-5 text-center">
</div>
<?php
if (!empty($_POST)) {
    if (!empty($_POST["quantity"])) {
        $productByCode = \ilsur\Models\Carpart::getCarpartById($_POST['item_id']);
        $itemArray = array(
            $productByCode[0]["id"] => array(
                'name' => $productByCode[0]["name"],
                'id' => $productByCode[0]["id"],
                'quantity' => $_POST["quantity"],
                'price' => $productByCode[0]["price"],
                'imageurl' => $productByCode[0]["imageurl"]));
        $id = $_POST['item_id'];
        if (!empty($_SESSION["cart_item"])) {
            if (in_array($productByCode[0]["id"], array_keys($_SESSION["cart_item"]))) {
                foreach ($_SESSION["cart_item"] as $key => $value) {
                    if ($productByCode[0]["id"] == $key) {
                        if (empty($_SESSION["cart_item"][$key]["quantity"])) {
                            $_SESSION["cart_item"][$key]["quantity"] = 0;
                        }
                        $_SESSION["cart_item"][$key]["quantity"] += $_POST["quantity"];
                    }
                }
            } else {
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
            }
        } else {
            $_SESSION["cart_item"] = $itemArray;
        }
    }
}
?>

<div class="col-lg-8 mx-auto row">

    <?php
    if (!empty($data['carparts'])) {
        foreach ($data['carparts'] as $id => $carpart) {
            $image = (empty($carpart['imageurl'])) ? '/image/def-carpart.jpg' : $carpart['imageurl'];
            if ($data['carparts'])
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="#"><img class="card-img-top" src="<?php echo $image ?>" alt=""></a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="#"><?php echo $carpart['name'] ?></a>
                </h4>
                <h5><?php echo $carpart['price'] ?>₽</h5>
                <p class="card-text"><?php echo $carpart['short_description'] ?></p>
            </div>
            <div class="card-footer">
                <form method="post" action="">
                    <input type="text" class="product-quantity" name="quantity" value="1" size="2"/>
                    <button class="btn btn-outline-primary" type="submit"
                            value="<?php echo implode(\ilsur\Models\Carpart::getCarpartIdByName($carpart['name'])); ?>"
                            name="item_id">Добавить в корзину
                    </button>
                </form>
            </div>
            </div>
            </div>
            <?php
        }
    }
    ?>

</div>
</body>
<!--<form method="post" href="add/--><?php //echo $carpart[$id]["code"]; ?><!--">-->
<!--    <input type="text" class="product-quantity" name="quantity" value="1" size="2"/>-->
<!--    <input type="submit" value="Добавить в корзину" class="btn btn-outline-primary">-->
<!--</form>-->