<?php


namespace ilsur;


use CommonClass;
use DbClass;

class User
{

    /**
     * Model functions
     */

    public static function getUserSchema(){
        return ['email', 'password'];
    }

    public static function getProfileData($id){
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))->dbFind('user', $id);
    }
    public static function findUserByEmail($email){
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))->dbFindBy(
            'user',
            ['email' => $email]);
    }
    public static function getUserList(){
        $profiles = (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))->dbSelectAll('user');
        // Remove credentials
        foreach ($profiles as $id => $profile) {
            unset($profile['password']);
            $profiles[$id] = $profile;
        }
        return $profiles;
    }
    public static function checkUser($email, $password){
        return (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))->dbFindBy(
            'user',
            [
                'email' => $email,
                'password' => CommonClass::getPasswordHash($password)
            ]
        );
    }

    /**
     * @param $user
     */
    static function addUser($user){
        $user['password'] = CommonClass::getPasswordHash($user['password']);
         (new DbClass("mysql:host=localhost;dbname=mycarpartstore", "root", "admin"))->dbAddUser(
             'user',
             $user);
    }


}