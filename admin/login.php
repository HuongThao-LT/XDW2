<?php

require_once('../env.php');
require_once('../includes/Database.php');
require_once("../includes/Session.php");
Session::init();
Session::checkLoginAdmin();


$title = 'Login';

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $adminType = 2;
        $data = Database::table('users')->select(['password'])->where([
            ['username', '=', $username], 
            ['type', '=', $adminType]
        ])->first();
        if ($data) {
            if (password_verify($password, $data['password'])) {
                Session::set('login_admin', true);
                Session::set('login_admin_username', $username);
                exit("Login Success");
            }
        }
    }
    
    exit("Login Failed");
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'logout') {
        Session::unset('login_admin');
        Session::unset('login_admin_username');
    }

    exit();
}

require_once('view/admin/login.php');