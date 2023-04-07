<?php

// env
require_once("env.php");

// inlcudes
require_once("includes/function.php");
require_once("includes/Database.php");
require_once("includes/Session.php");
Session::init();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if($action == 'logout') {
        Session::unset('login_user');
        Session::unset('login_user_username');
        Session::unset('login_user_id');
    }

    exit();
}
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $data = Database::table('users')->where([
            ['username', '=', $username]
        ])->first();
        if ($data) {
            if (password_verify($password, $data['password'])) {
                Session::set('login_user', true);
                Session::set('login_user_username', $data['username']);
                Session::set('login_user_id', $data['id']);
                exit("Login Success");
            }
        }
    }
    
    exit("Login Failed");
}

exit(json_encode('Success'));