<h1>Sign in</h1>
<div>
<!--    --><?php
//    if (isset($_POST['submitted'])) {
//        $email = $_POST['email'];
//        $password = $_POST['password'];
//        if (!empty($data['notices'])) {
//            echo '<ul class="form-errors">';
//            foreach ($data['notices'] as $notice) {
//                echo '<li>' . $notice . '</li>';
//            }
//            echo '</ul>';
//        }
//        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/../src/site/data/user.csv')) {
//            echo "Cannot find file.";
//        } else {
//            $content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../src/site/data/user.csv');
//            $fields = array();
//            foreach (explode("\n", $content) as $line) {
//                array_push($fields, str_getcsv($line));
//            }
//            foreach ($fields as $field) {
//                if($field[1] == $email && $field[2] == $password)
//                    echo "Authentication successful!";
//            }
//        }
//    }
//    ?>

    <form action="auth" method="POST">
        <div class="form-group">
            <label for="reg-email">Email</label>
            <input type="email" class="form-control"
                   id="reg-email" name="email" placeholder="Email"
                <?php echo(empty($_POST['email']) ? '' : ' value="' . $_POST['email'] . '"'); ?>>
        </div>
        <div class="form-group">
            <label for="reg-password">Password</label>
            <input type="password" class="form-control"
                   id="reg-password" name="password" placeholder="Password">
        </div>
        <button type="submit" name="submitted" class="btn btn-default">Authorize</button>
    </form>
</div>