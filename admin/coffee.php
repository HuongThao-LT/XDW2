<?php

require_once('../env.php');
require_once('../includes/Database.php');
require_once("../includes/Session.php");
Session::init();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'index':
            $title = 'Coffee - List';
            require_once('view/coffee/index.php');
            break;
        case 'create':
            $title = 'Coffee - Create';
            $coffee_brands = Database::table('coffee_brands')->get();
            $coffee_types = Database::table('coffee_types')->get();
            require_once('view/coffee/create.php');
            break;
        case 'details':
            $title = 'Coffee - Details';
            $coffee_details_id='';
            if (isset($_GET['id'])) {
                $coffee_details_id = $_GET['id'];
            }

            $coffee_details = Database::table('coffees')->where([['id', '=', $coffee_details_id]])->first();
            if(!$coffee_details) {
                require_once('view/404.php');
                exit();
            }

            require_once('view/coffee/details.php');
            break;
        case 'edit':
            $title = 'Coffee - Edit';
            $coffee_brands = Database::table('coffee_brands')->get();
            $coffee_types = Database::table('coffee_types')->get();

            $coffee_edit_id='';
            if (isset($_GET['id'])) {
                $coffee_edit_id = $_GET['id'];
            }
            
            $coffee_edit = Database::table('coffees')->where([['id', '=', $coffee_edit_id]])->first();
            if(!$coffee_edit) {
                require_once('view/404.php');
                exit();
            }

            require_once('view/coffee/edit.php');
            break;
        default:
            require_once('view/404.php');
            break;
    }

} else {
    $title = 'Coffee - List';
    require_once('view/coffee/index.php');
}