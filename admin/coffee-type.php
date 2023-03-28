<?php

require_once('../env.php');
require_once('../includes/Database.php');
require_once("../includes/Session.php");
Session::init();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'index':
            $title = 'Coffee Type - List';
            require_once('view/coffee-type/index.php');
            break;
        case 'create':
            $title = 'Coffee Type - Create';
            require_once('view/coffee-type/create.php');
            break;
        case 'details':
            $title = 'Coffee Type - Details';
            $coffee_type_details_id='';
            if (isset($_GET['id'])) {
                $coffee_type_details_id = $_GET['id'];
            }

            $coffee_type_details = Database::table('coffee_types')->where([['id', '=', $coffee_type_details_id]])->first();
            if(!$coffee_type_details) {
                require_once('view/404.php');
                exit();
            }

            require_once('view/coffee-type/details.php');
            break;
        case 'edit':
            $title = 'Coffee Type - Edit';
            $coffee_type_edit_id='';
            if (isset($_GET['id'])) {
                $coffee_type_edit_id = $_GET['id'];
            }

            $coffee_type_edit = Database::table('coffee_types')->where([['id', '=', $coffee_type_edit_id]])->first();
            if(!$coffee_type_edit) {
                require_once('view/404.php');
                exit();
            }

            require_once('view/coffee-type/edit.php');
            break;
        default:
            require_once('view/404.php');
            break;
    }
} else {
    $title = 'Coffee Type - List';
    require_once('view/coffee-type/index.php');
}