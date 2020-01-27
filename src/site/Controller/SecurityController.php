<?php


namespace ilsur\Controller;


use CommonClass;
use CoreClass;
use ilsur\Models\Carpart;
use ilsur\User;
use PDO;
use PDOException;
use Symfony\Component\HttpFoundation\Response;

class SecurityController
{
    /**
     * Sign in action.
     *
     * @return Response
     */
    static function actionSecurityAuth()
    {
        // Process request with using of models
        $id = NULL;
        $data = [];
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $authorized = CommonClass::authorize($_POST['email'], $_POST['password']);
            if ($authorized) {
                $id = CommonClass::get_authorized_user()['id'];
            } else {
                echo "Wrong email-password pair!";
                $data['notices'] = [
                    'Wrong email-password pair!',
                ];
                echo $data['notices'];
            }
        }
        // Make Response Data
        if (empty($id)) {
            return (new CoreClass)->createResponse(['view' => 'security/auth', 'data' => $data], 200);
        } else {
            return (new CoreClass)->createResponse(['view' => 'security/auth'], 200);
        }
    }

    /**
     * Sign out action
     *
     * @return Response
     */
    static function actionSecurityLogout()
    {
        CommonClass::logout();
        $carparts = Carpart::getCarpartList();
        return (new CoreClass)->createResponse(['view' => '/carpart/list', 'data' => [
            'carparts' => $carparts
        ]], 200);
    }

    /**
     * Registration action
     *
     * @return Response
     */
    static function actionSecurityReg()
    {
        $notices = [];
        $generalNotice = '';
        // Entity array
        $user = CommonClass::fill_entity(User::getUserSchema(), []);
        // The best way to check if form has been submited
        // is check var connected to button
        var_dump($_POST);
        if (isset($_POST['submitted'])) {
            // Validation
            $user = CommonClass::fill_entity(User::getUserSchema(), $_POST);
            // It's better to fill entity array with all data -
            // it should be connected to form for easier proccessing
            $user['password_confirm'] = $_POST['password_confirm'];
            $user['terms'] = isset($_POST['terms']) ? true : false;
            // In real project that would be moved to some special validation module
            if (!strlen($user['email'])) {
                $notices['email'] = 'You must fill this field.';
            } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                $notices['email'] = 'Email has incorrect format.';
            }
            if (!strlen($user['password'])) {
                $notices['password'] = 'You must fill this field.';
            } elseif (strlen($user['password']) < 2) {
                $notices['password'] = 'Password\'s length must be greater than 2 symbols.';
            }
            if (!strlen($user['password_confirm'])) {
                $notices['password_confirm'] = 'You must fill this field.';
            } elseif ($user['password_confirm'] !== $user['password']) {
                $notices['password_confirm'] = 'Password Repeat must be the same as Password.';
            }
            if (!strlen($user['terms'])) {
                $notices['terms'] = 'You must check this field.';
            }
            // Validated?
            if (!count($notices)) {
                if (User::findUserByEmail($user['email'])) {
                    $generalNotice = 'User with such email already exists.';
                } else {
                    User::addUser($user);//Here we also have to check for errors
                    header('Location:/?status=registered');//Here it's better to use flash session variable
                    exit();
                }
            }
        }
        return (new CoreClass)->createResponse(['view' => 'security/reg',
            'data' => [
                'user' => $user,
                'notices' => $notices,
                'generalNotice' => $generalNotice,
            ]], 200);
    }
}