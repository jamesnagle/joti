<?php 
namespace Eks;

use Eks\Models\User;

class EksAuth {
    public static function isValid($submitted_pass, $db_pass) {
        if (password_verify($submitted_pass, $db_pass)) {
            return true;
        } else {
            return false;
        }
    }
    public static function login($username, $password) {
        $user = User::where('username', '=', $username)->first();
        if (!$user) {
            return false;
        }
        if (!EksAuth::isValid($password, $user->password)) {
            return false;
        }
        session_start();

        $_SESSION['eks_user'] = $user;

        return true;
    }
    public static function isLoggedIn() {
        if (isset($_SESSION['eks_user'])) {
            return true;
        } else {
            return false;
        }
    }
    public static function user() {
        if (EksAuth::isLoggedIn()) {
            return $_SESSION['eks_user'];
        } else {
            return false;
        }
    }
    public static function logout() {
        session_destroy();
        return true;
    }
    public static function hash($password) {
        $options = [
            'cost' => 12,
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
}