<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Bootstrap Library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- Jquery Library -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js" integrity="sha256-0H3Nuz3aug3afVbUlsu12Puxva3CP4EhJtPExqs54Vg=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="public/css/layout.css">

    <!-- Axios Library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <title><?=$title ?? 'Coffee Shop'?></title>
</head>

<body>
    <div id="navbar">
        <div id="navbar-brand">
            <h2><a href="<?=APP_URL?>"><span class="lab la-accusoft"></span><span>Coffee Shop</span></a></h2>
        </div>
        <label for="nav-mobile-togger" id="nav-mobile-btn">
            <span class="las la-bars"></span>
        </label>
        <nav id="navbar-menu">
            <ul>
                <li><a href=""><span>Product</span></a></li>
                <li>
                    <a href=""><span>About</span></a>
                </li>
                <li>
                    <a href=""><span>Contacts</span></a>
                </li>
                <li><a href=""><span class="las la-shopping-bag"></span><span>Order</span></a></li>
                <li><a href=""><span class="las la-user-circle"></span><span>Account</span></a></li>
            </ul>
        </nav>
    </div>
    <input type="checkbox" hidden id="nav-mobile-togger">
    <label for="nav-mobile-togger" id="nav-overlay"></label>
    <!-- nav-mobile -->
    <div id="nav-mobile">
        <div id="nav-mobile-brand">
            <h2 id="brand-name"><a href=""><span class="lab la-accusoft"></span><span>Coffee Shop</span></a></h2>
            <label for="nav-mobile-togger" id="nav-mobile-close">X</label>
        </div>
        <ul id="nav-mobile-menu">
            <li><a href=""><span>Product</span></a></li>
            <li>
                <a href=""><span>About</span></a>
            </li>
            <li>
                <a href=""><span>Contacts</span></a>
            </li>
            <li><a href=""><span class="las la-shopping-bag"></span><span>Order</span></a></li>
            <li><a href=""><span class="las la-user-circle"></span><span>Account</span></a></li>
        </ul>
    </div>
    <input type="hidden" id="app-url" value="<?=APP_URL?>">
    <input type="hidden" id="api-url" value="<?=API_URL?>">
    <input type="hidden" id="coffee-image-path" value="<?=COFFEE_IMAGE_PATH?>">

    <div class="search-bar" >
        <form id="coffee-search-form" action="<?=APP_URL?>index.php">
            <input type="hidden" id="search-action" name="action" value="<?=$searchAction?>">
            <div class="search-info">
                <div class="search-wrapper bottom">
                    <button>
                        <span class="las la-search"></span>
                    </button>
                    <input type="search" id="search-keywords" value="<?=$searchKeywords ?? ''?>" name="keywords" placeholder="Search here" class="input-search">
                </div>
                <button type="button" id="search-toggle" class="drop-down"><?=$searchAction == 'search' ? 'Advanced Search' : 'Normal Search'?></button>
            </div>
            <?php
                if ($searchAction == 'advanced-search') {
                    ?>
                        <div style="display:block;" class="filter" id="advanced-search-filter">
                            <div class="row">
                                <span style="margin-right: 5px">Type:</span> 
                                <select id="search-coffee-type" name="coffee-type" id="search-coffee-type" >
                                    <option value="">All Type</option>
                                    <?php
                                    foreach ($coffee_types as $coffee_type) {
                                        ?>
                                        <option <?= ($searchType ?? '') == $coffee_type['id'] ? 'selected' : '' ?> value="<?=$coffee_type['id']?>"><?=$coffee_type['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span style="margin: 0 5px 0 20px">Brand:</span> 
                                <select id="search-coffee-brand" name="coffee-brand" id="search-coffee-brand">
                                    <option value="">All Brand</option>
                                    <?php
                                    foreach ($coffee_brands as $coffee_brand) {
                                        ?>
                                        <option <?= ($searchBrand ?? '') == $coffee_brand['id'] ? 'selected' : '' ?> value="<?=$coffee_brand['id']?>"><?=$coffee_brand['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row">
                                <div>
                                    <input type="hidden" name="coffee-date" id="search-coffee-date">
                                    <span style="margin-right: 5px">Date From:</span> <input id="search-from-date" type="date" value="<?=$minDate ?? ''?>">
                                    <span style="margin: 0 5px 0 20px">To:</span> <input id="search-to-date" type="date" value="<?=$maxDate ?? ''?>" ><br>
                                    <span class="search-error text-danger" style="font-size:12px; margin-left: 100px" id="search-date-error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div>
                                    <input type="hidden" name="coffee-price" id="search-coffee-price">
                                    <span style="margin-right: 5px">Price From:</span> <input id="search-from-price" value="<?=$minPrice ?? ''?>" >
                                    <span style="margin: 0 5px 0 20px">To:</span> <input id="search-to-price" value="<?=$maxPrice ?? ''?>" ><br>
                                    <span class="search-error text-danger" style="font-size:12px; margin-left: 100px" id="search-price-error"></span>
                                </div>
                            </div>
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="filter" id="advanced-search-filter">
                            <div class="row">
                                <span style="margin-right: 5px">Type:</span> 
                                <select id="search-coffee-type" name="coffee-type" id="search-coffee-type" disabled>
                                    <option value="">All Type</option>
                                    <?php
                                    foreach ($coffee_types as $coffee_type) {
                                        ?>
                                        <option value="<?=$coffee_type['id']?>"><?=$coffee_type['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span style="margin: 0 5px 0 20px">Brand:</span> 
                                <select id="search-coffee-brand" name="coffee-brand" id="search-coffee-brand" disabled>
                                    <option value="">All Brand</option>
                                    <?php
                                    foreach ($coffee_brands as $coffee_brand) {
                                        ?>
                                        <option value="<?=$coffee_brand['id']?>"><?=$coffee_brand['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row">
                                <div>
                                    <input type="hidden" name="coffee-date" id="search-coffee-date" disabled>
                                    <span style="margin-right: 5px">Date From:</span> <input id="search-from-date" type="date" disabled>
                                    <span style="margin: 0 5px 0 20px">To:</span> <input id="search-to-date" type="date" disabled><br>
                                    <span class="search-error text-danger" style="font-size:12px; margin-left: 100px" id="search-date-error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div>
                                    <input type="hidden" name="coffee-price" id="search-coffee-price" disabled>
                                    <span style="margin-right: 5px">Price From:</span> <input id="search-from-price" disabled>
                                    <span style="margin: 0 5px 0 20px">To:</span> <input id="search-to-price" disabled><br>
                                    <span class="search-error text-danger" style="font-size:12px; margin-left: 100px" id="search-price-error"></span>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>

        </form>
    </div>

    <div id="main-content">
        <section class="content">