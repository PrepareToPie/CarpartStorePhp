<body>
<div class="col-lg-8 mx-auto">
    <div class="row">
        <div class="py-5 text-center">
            <h3>Пожалуйста, заполните форму:</h3>
        </div>
        <div class="col-md-8 order-md-1">
            <div asp-validation-summary="All"></div>
            <form action="checkout" method="POST" class="form-horizontal" novalidate="" role="form">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="last_name"></label>
                        <input type="text" class="form-control" id="last_name" placeholder="Ваше имя"
                               name="last_name" required/>
                        <span class="input-group-addon"></span>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="first_name"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="first_name" placeholder="Ваша фамилия"
                                   name="first_name" required/>
                            <span class="input-group-addon"></span>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group mb-3">
                    <label for="address_line1"></label>
                    <input type="text" class="form-control" id="address_line1" placeholder="Адрес отправки"
                           name="address_line1" required/>
                    <span class="text-danger"></span>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="address_line2"></label>
                    <input type="text" class="form-control" id="address_line2"
                           placeholder="Дополнительный адрес отправки(опционально)"
                           name="address_line2"/>
                    <span class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="zip_code" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="zip_code" placeholder="Почтовый индекс"
                               name="zip_code" required/>
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="city"></label>
                    <input type="text" class="form-control" id="city" placeholder="Город отправки"
                           name="city" required/>
                    <span class="text-danger"></span>
                    <div class="invalid-feedback">
                        Please enter your city.
                    </div>
                </div>

                <div class="form-group">
                    <label for="state"></label>
                    <input type="text" class="form-control" id="state" placeholder="Регион отправки"
                           name="state" required/>
                    <span class="text-danger"></span>
                    <div class="invalid-feedback">
                        Please enter your state.
                    </div>
                </div>

                <div class="form-group">
                    <label for="country"></label>
                    <input type="text" class="form-control" id="country" placeholder="Страна отправки"
                           name="country" required/>
                    <span class="text-danger"></span>
                    <div class="invalid-feedback">
                        Please enter your country.
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone_number" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone_number" placeholder="Номер телефона"
                               name="phone_number" required/>
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Эл. почта"
                               name="email" required/>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="btn-group mr-md-offset-2 mr-md-8">
                        <input class="btn btn-success" type="submit" value="Сделать заказ"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>