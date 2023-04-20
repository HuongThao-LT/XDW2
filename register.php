<?php
require_once("env.php");

require_once("includes/function.php");
require_once("includes/Database.php");
require_once("includes/Session.php");

$isValidated = true;
if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phonenumber']) && isset($_POST['username']) && isset($_POST['password'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phonenumber = trim($_POST['phonenumber']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $isValidated = true;
        $data = Database::table('users')->where([
            ['username', '=', $username]
        ])->first();
        if($data) {
            $isValidated = false;
            $_SESSION['status'] = "Username đã tồn tại!";
            $_SESSION['status_code'] = "error";
        }
        $data = Database::table('users')->where([
            ['email', '=', $email]
        ])->first();
        if($data) {
            $isValidated = false;
            $_SESSION['status'] = "Email đã tồn tại!";
            $_SESSION['status_code'] = "error";

        }
        $data = Database::table('users')->where([
            ['phone', '=', $phonenumber]
        ])->first();
        if($data) {

            $isValidated = false;
            $_SESSION['status'] = "Số điện thoại đã tồn tại!";
                $_SESSION['status_code'] = "error";
        }
        if($isValidated) {
            $data = Database::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'phone' => $phonenumber,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            if ($data) {
                $_SESSION['status'] = "Đăng ký thành công! Bạn sẽ trở lại trang chủ trong giây lát!";
                $_SESSION['status_code'] = "success";
            }
        }
    }
}require_once('view/site/register.php');
