<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>CarpartsStore</title>
    <link rel="stylesheet" type="text/css" href="/lib/bootstrap/dist/css/bootstrap.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="`/css/main.css"/>
    <script src="/lib/jquery/jquery.js"></script>
    <script src="/lib/bootstrap/dist/js/bootstrap.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top" role="navigation">
    <a class="navbar-brand" href="/carpart/list/">CarpartsStore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarColor01" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    Категории
                </a>
                <ul class="dropdown-menu">
                    <?php
                    $categories = \ilsur\Models\Category::getCategory();
                    foreach ($categories as $category) {
                        ?>
                        <li>
                            <a class="dropdown-item"
                               href="/carpart/list/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                        </li>
                        <?php
                    }
                    ?>

                    <li class="dropdown-item"></li>
                    <li>
                        <a class="dropdown-item" href="/carpart/list/">Посмотреть
                            все</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/carpart/list/in_stock">В наличии</a>
                    </li>
                </ul>
            </li>

            <!--                @await Component.InvokeAsync("CategoryMenu")-->
            <li class="nav-item"><a class="nav-link" href="/shopcart/list/">Корзина</a></li>
            <?php
            if (!empty($user)) {
                ?>
                <li class="nav-item"><a class="nav-link" href="/order/list">Мои заказы</a></li>
                <li class="nav-item"><a class="nav-link" href="/security/logout">Выйти</a></li>
                <?php
            } else {
                ?>
                <li class="nav-item"><a class="nav-link" href="/security/auth">Логин</a></li>
                <li class="nav-item"><a class="nav-link" href="/security/reg">Регистрация</a></li>
                <?php
            }
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="/carpart/search" name="search">
            <input class="form-control mr-sm-2" type="text" placeholder="Поиск по VIN" name="vin" required>
            <button class="btn btn-light my-2 my-sm-0" type="submit">Поиск</button>
        </form>
    </div>
</nav>
<div class="col-lg-8 mx-auto">
</div>
</body>
</html>
