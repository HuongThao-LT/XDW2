<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title ?? "Admin"?></title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Bootstrap Library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Datatable Jquery-->
    <link rel="stylesheet" href="http://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- JS Cookie -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js" integrity="sha256-0H3Nuz3aug3afVbUlsu12Puxva3CP4EhJtPExqs54Vg=" crossorigin="anonymous"></script>

    <!-- Jquery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    <!-- Axios Library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"> Coffee Shop</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="<?=APP_URL?>admin/"><span class="las la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="<?=APP_URL?>admin/coffee.php"><span class="las la-clipboard-list"></span>
                    <span>Coffees</span></a>
                </li>
                <li>
                    <a href="<?=APP_URL?>admin/coffee-brand.php"><span class="las la-clipboard-list"></span>
                    <span>Coffee Brands</span></a>
                </li>
                <li>
                    <a href="<?=APP_URL?>admin/coffee-type.php"><span class="las la-clipboard-list"></span>
                    <span>Coffee Types</span></a>
                </li>
                <li>
                    <a href="<?=APP_URL?>admin/"><span class="las la-users"></span>
                    <span>Customers</span></a>
                </li>
                <li>
                    <a href="#"><span class="las la-shopping-bag"></span>
                    <span>Orders</span></a>
                </li>
                <li>
                    <a href="#"><span class="las la-receipt"></span>
                    <span>Inventory</span></a>
                </li>
                <li>
                    <a href="#"><span class="las la-user-circle"></span>
                    <span>Accounts</span></a>
                </li>
                <li>
                    <a href="#"><span class="las la-clipboard"></span>
                    <span>Tasks</span></a>
                </li>
                <li>
                    <button id="admin-logout"><span class="las la-clipboard"></span>
                    <span>Logout</span></button>
                </li>
            </ul>
        </div>
    </div>
    <input type="hidden" id="app-url" value="<?=APP_URL?>">
    <input type="hidden" id="api-url" value="<?=API_URL?>">
    <input type="hidden" id="access-token" value="<?=ACCESS_TOKEN?>">
    <input type="hidden" id="coffee-image-path" value="<?=COFFEE_IMAGE_PATH?>">
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Dashboard
            </h2>
            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here">
            </div>
            <div class="user-wrapper">
                <div>
                    <?php
                        if (Session::get('login_admin')) {
                            ?>
                                <h4><?=Session::get('login_admin_username')?></h4>
                            <?php
                        } else {
                            ?>
                                <h4>Admin</h4>
                            <?php
                        }
                    ?>
                    <small>Super admin</small>
                </div>
            </div>
        </header>
        <main>