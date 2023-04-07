<?php require_once('view/site_layout/header.php'); ?>
<!-- Start Content -->
<div>
    <h4>Search Result: <?= $searchResultCount?> item(s)</h4>
    <h5>Keywords: <?= $searchKeywords?></h5>
</div>
<div class="container">
    <?php
        if ($searchResultCount == 0) {
            ?>
                <div style="text-align:center; font-size: 20px; margin-top: 50px">
                    NO COFFEES FOUND
                </div>
            <?php
        } else {
            foreach ($searchResult->data as $key => $coffee) {
                ?>
                    <div class="card" style="width:100%">
                        <form class="add-to-cart-form" method="POST">
                            <input type="hidden" name="coffee-id" value="<?=$coffee['id']?>">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md col-lg col-xl">
                                        <img 
                                            style="height: 80px; width: 80px"
                                            src="<?=COFFEE_IMAGE_PATH.$coffee['image']?>" 
                                            alt="<?=$coffee['name']?>" 
                                        >
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2 "><?=$coffee['name']?></p>
                                        <p><span class="text-muted">Brand: <?=$coffee['coffee_brand']?></span> <br><span class="text-muted">Type: <?=$coffee['coffee_type']?></span></p>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-arrow-up"></i>
                                        </button>

                                        <input style="min-width:50px" min="1" value="1" name="qty" type="number" class="form-control form-control-sm" />

                                        <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-arrow-down"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h5 class="mb-0">$<?=$coffee['price']?></h5>
                                    </div>
                                    <input type="submit" class="add-to-cart-btn" value="Add to Cart">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
            }
        }
    ?>
</div>
<?=$searchResult->link()?>
<!-- End Content -->
<?php require_once('view/site_layout/sidebar.php'); ?>
<?php require_once('view/site_layout/footer.php'); ?>