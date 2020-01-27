<!DOCTYPE HTML>
<html>
<head>
    <title>Sign-Up</title>
    <link rel="stylesheet" type="text/css" href="/web/css/main.css"/>
</head>
<body>
<form method="POST" action="reg">
    <div>
        <h1>Registration</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label class="control-label" for="username"><b>Username</b></label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username"
               <?= empty($data['user']['name']) ? '' : 'value="' . $data['user']['name'] . '"' ?> required>

        <label class="control-label" for="email"><b>Email</b></label>
        <input type="text" class="form-control" id="email" placeholder="example@gmail.com" name="email"
               <?= empty($data['user']['email']) ? '' : 'value="' . $data['user']['email'] . '"' ?> required>

        <label class="control-label" for="psw"><b>Password</b></label>
        <input type="password" class="form-control" id="psw" placeholder="Enter Password" name="password"
               <?= empty($data['user']['password']) ? '' : 'value="' . $data['user']['password'] . '"' ?> required>

        <label class="control-label" for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" class="form-control" id="psw-repeat" placeholder="Repeat Password"
               name="password_confirm"
               <?= empty($data['user']['password_confirm']) ? '' : 'value="' . $data['user']['password_confirm'] . '"' ?>
               required>

        <label class="radio" for="gender"><b>Your gender</b></label>
        <p>
            <input type="radio" class="radio" id="gender" name="gender" value="male" required>male<br>
            <input type="radio" class="radio" id="gender" name="gender" value="female">female
        </p>

        <label class="control-label" for="country"><b>Country</b></label>
        <input type="text" class="form-control" id="country" placeholder="Where are you from?" name="country"
               <?= empty($data['user']['country']) ? '' : 'value="' . $data['user']['country'] . '"' ?> required>

        <label class="control-label" for="about"><b>About you</b></label>
        <textarea id="about" class="form-control" name="about" placeholder="Tell us about you..."
                  style="height:200px"></textarea>

        <label class="control-label" for="terms"><b>I agree to have my personal data processed: </b></label>
        <input type="checkbox" class="radio" name="terms" id="terms" required><br>
        <button type="submit" name="submitted" class="btn btn-default">Register</button>
    </div>
</form>
</body>


</html>