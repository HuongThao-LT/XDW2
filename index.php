<?php

// env
require_once("env.php");

// inlcudes
require_once("includes/function.php");
require_once("includes/Database.php");
require_once("includes/Session.php");
require_once("includes/Class_Cart.php");
Session::init();

$searchAction = 'search';

$cart = Cart::loadOrCreate();

$coffees_latest = Database::table('coffees')->take(4)->orderBy(['id' => 'DESC'])->get();
$coffee_brands = Database::table('coffee_brands')->get();
$coffee_types = Database::table('coffee_types')->get();

foreach ($coffee_brands as $key => $coffee_brand) {
    $coffee_brands[$key]['coffees_list'] = Database::table('coffees')
        ->where([['brand', '=', $coffee_brand['id']]])
        ->take(4)
        ->get();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'index') {
        require_once('view/site/home.php');
    } else if ($action == 'search' || $action='advanced-search') {
        $searchAction = $action;
        $condition = [];
        if (isset($_GET['keywords'])) {
            $searchKeywords = trim($_GET['keywords']);
            $condition[] = ['coffees.name', 'LIKE', '%' . $searchKeywords . '%'];
        }

        if ($action == 'advanced-search') {
            if (isset($_GET['coffee-brand']) && $_GET['coffee-brand'] != '') {
                $searchBrand = trim($_GET['coffee-brand']);
                $condition[] = ['coffees.brand', '=', $searchBrand];
            }

            if (isset($_GET['coffee-type']) && $_GET['coffee-type'] != '') {
                $searchType = trim($_GET['coffee-type']);
                $condition[] = ['coffees.type', '=', $searchType];
            }

            if (isset($_GET['coffee-price'])) {
                $searchPrice = explode(',', trim($_GET['coffee-price']));
                if (count($searchPrice) == 2) {
                    $minPrice = $searchPrice[0];
                    $maxPrice = $searchPrice[1];

                    if (is_numeric($minPrice) && is_numeric($maxPrice)) {
                        if ($minPrice <= $maxPrice) {
                            $condition[] = ['coffees.price', '>=', $minPrice];
                            $condition[] = ['coffees.price', '<=', $maxPrice];
                        }
                    }
                }
            }

            if (isset($_GET['coffee-date'])) {
                $searchDate = explode(',', trim($_GET['coffee-date']));
                if (count($searchDate) == 2) {
                    $minDate = $searchDate[0];
                    $maxDate = $searchDate[1];
                    if (isRealDate($minDate) && isRealDate($maxDate)) {
                        if ($minDate <= $maxDate) {
                            $condition[] = ['coffees.created_at', '>=', $minDate];
                            $condition[] = ['coffees.created_at', '<=', $maxDate];
                        }
                    }
                }
            }
        }

        $searchResult = Database::table('coffees')
            ->select(['coffees.*', 'coffee_brands.name as coffee_brand', 'coffee_types.name as coffee_type'])
            ->join('coffee_brands', 'coffees.brand', '=', 'coffee_brands.id')
            ->join('coffee_types', 'coffees.type', '=', 'coffee_types.id')
            ->where($condition)
            ->paginate(10);
        $searchResultCount = $searchResult->totalRow;

        require_once('view/site/search.php');
    }else if($action == 'register') {
        require_once('view/site/home.php');
    }

} else {
    require_once('view/site/home.php');
}


