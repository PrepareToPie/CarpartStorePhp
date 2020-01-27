<?php
if (!empty($_GET)) {
    if ($_GET["action"] == "remove") {
        \ilsur\Models\Order::deleteOrder($_GET["id"]);
        header("Location: order/list.php");
    }
}
?>
<body>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>"Ваши заказы"</h2>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя <i class="fa fa-sort"></i></th>
                <th>Адрес</th>
                <th>Доп. адрес</th>
                <th>Почтовый индекс</th>
                <th>Город <i class="fa fa-sort"></i></th>
                <th>Регион</th>
                <th>Страна <i class="fa fa-sort"></i></th>
                <th>Тел. номер</th>
                <th>Дата</th>
                <th>Сумма</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data['orders'] as $order) {
                ?>
                <tr>
                    <td><?php echo $order['id'] ?></td>
                    <td><?php echo $order['first_name'] . ' ' . $order['last_name'] ?></td>
                    <td><?php echo $order['address_line1'] ?></td>
                    <td><?php echo (empty($order['address_line2'])) ? '-' : $order['address_line2'] ?></td>
                    <td><?php echo $order['zip_code'] ?></td>
                    <td><?php echo $order['city'] ?></td>
                    <td><?php echo $order['state'] ?></td>
                    <td><?php echo $order['country'] ?></td>
                    <td><?php echo $order['phone_number'] ?></td>
                    <td><?php echo $order['order_placed'] ?></td>
                    <td><?php echo $order['order_total'] ?></td>
                    <td>
                        <a href="/order/list?action=view&id=<?php echo $order['id']; ?> " class="view" title=""
                           data-toggle="tooltip" data-original-title="View"><i
                                    class="fa fa-eye"></i></a>
<!--                        <a href="#" class="edit" title="" data-toggle="tooltip" data-original-title="Edit"><i-->
<!--                                    class="fa fa-edit"></i></a>-->
                        <a href="/order/list?action=remove&id=<?php echo $order['id']; ?>" class="delete" title=""
                           data-toggle="tooltip" data-original-title="Delete"><i
                                    class="fa fa-trash"> </i>
                        </a>
                    </td>
                </tr>
                <?php
                if (!empty($_GET)) {
                    if ($_GET["action"] == "view" && $_GET["id"] == $order['id']) { ?>

                        <table class="table table-sm table-responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Деталь</th>
                                <th>Производитель</th>
                                <th>Кол-во</th>
                                <th>Цена за шт.</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($order['items'] as $item) {
                                ?>
                                <tr>
                                    <td><?php echo $item['carpart_id'] ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['manufacturer'] ?></td>
                                    <td><?php echo $item['amount'] ?></td>
                                    <td><?php echo $item['price'] ?></td>
                                </tr>
                                <?php
                            } ?>
                            </tbody>
                        </table>
                        <?php
                    }
                }
                ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>