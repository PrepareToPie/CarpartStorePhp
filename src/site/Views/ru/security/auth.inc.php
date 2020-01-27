<!DOCTYPE HTML>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="card-header">Авторизация</h1>
                <form action="auth" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="cols-sm-2 control-label" for="email"><b>Email</b></label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"
                                                                       aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" id="email" placeholder="example@gmail.com"
                                           name="email"
                                           <?= empty($data['user']['email']) ? '' : 'value="' . $data['user']['email'] . '"' ?>
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="cols-sm-2 control-label" for="psw"><b>Пароль</b></label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"
                                                                       aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" id="psw"
                                           placeholder="Enter Password"
                                           name="password"
                                           <?= empty($data['user']['password']) ? '' : 'value="' . $data['user']['password'] . '"' ?>
                                           required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submitted"
                                class="btn btn-primary btn-lg btn-block login-button">
                            Авторизоваться
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>