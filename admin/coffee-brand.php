<?php

require_once('../env.php');
require_once('../includes/Database.php');
require_once("../includes/Session.php");
Session::init();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'index':
            $title = 'Coffee Brand - List';
            require_once('view/coffee-brand/index.php');
            break;
        case 'create':
            $title = 'Coffee Brand - Create';
            require_once('view/coffee-brand/create.php');
            break;
        case 'details':
            $title = 'Coffee Brand - Details';
            $coffee_brand_details_id='';
            if (isset($_GET['id'])) {
                $coffee_brand_details_id = $_GET['id'];
            }

            $coffee_brand_details = Database::table('coffee_brands')->where([['id', '=', $coffee_brand_details_id]])->first();
            if(!$coffee_brand_details) {
                require_once('view/404.php');
                exit();
            }

            require_once('view/coffee-brand/details.php');
            break;
        case 'edit':
            $title = 'Coffee Brand - Edit';
            $coffee_brand_edit_id='';
            if (isset($_GET['id'])) {
                $coffee_brand_edit_id = $_GET['id'];
            }

            $coffee_brand_edit = Database::table('coffee_brands')->where([['id', '=', $coffee_brand_edit_id]])->first();
            if(!$coffee_brand_edit) {
                require_once('view/404.php');
                exit();
            }

            require_once('view/coffee-brand/edit.php');
            break;
        default:
            require_once('view/404.php');
            break;
    }
} else {
    $title = 'Coffee Brand - List';
    require_once('view/coffee-brand/index.php');
}