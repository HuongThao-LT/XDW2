<?php require_once('view/site_layout/header.php'); ?>
<!-- Start Content -->
<div id="latest">
    <div id="latest-name">
        <h2>Latest</h2>
        <div class="latest-seemore"><a href="">See more</a></div>
    </div>
    <div id="latest-all-card">
        <?php 
            if (count($coffees_latest) <= 0) {
                ?>
                    <div style="width:100%; text-align:center; font-size: 16px;">NO PRODUCT</div>
                <?php
            } else {
                foreach ($coffees_latest as $coffee_latest) {
                    ?>
                        <div class="card">
                            <form class="add-to-cart-form" method="POST">
                                <input type="hidden" name="coffee-id" value="<?=$coffee_latest['id']?>">
                                <input type="hidden" name="qty" value="1">
                                <div class="card-image">
                                    <img src="<?=COFFEE_IMAGE_PATH.$coffee_latest['image']?>" alt="<?=$coffee_latest['name']?>">
                                </div>
                                <div class="card-name"><a href="#"><?=$coffee_latest['name']?></a></div>
                                <div class="card-details">
                                    <div class="card-price"><?=$coffee_latest['price']?>$</div>
                                </div>
                                <input type="submit" class="add-to-cart-btn" value="Add to Cart">
                            </form>
                        </div>
                    <?php
                }
            }
        ?>
    </div>
</div>
<?php 
    foreach ($coffee_brands as $coffee_brand) {
        ?>
            <div id="main-name">
                <h2><?=$coffee_brand['name']?></h2>
            </div>
            <div class="all-card">
                <?php
                if (count($coffee_brand['coffees_list']) <= 0) {
                    ?>
                        <div style="width:100%; text-align:center; font-size: 16px;">NO PRODUCT</div>
                    <?php
                } else {
                    foreach ($coffee_brand['coffees_list'] as $coffee) {
                        ?>
                            <div class="card">
                                <form class="add-to-cart-form" method="POST">
                                    <input type="hidden" name="coffee-id" value="<?=$coffee['id']?>">
                                    <input type="hidden" name="qty" value="1">
                                    <div class="card-image">
                                        <img src="<?=COFFEE_IMAGE_PATH.$coffee['image']?>" alt="<?=$coffee['name']?>">
                                    </div>
                                    <div class="card-name"><a href="#"><?=$coffee['name']?></a></div>
                                    <div class="card-details">
                                        <div class="card-price"><?=$coffee['price']?>$</div>
                                    </div>
                                    <input type="submit" class="add-to-cart-btn" value="Add to Cart">
                                </form>
                            </div>
                        <?php
                    }
                }
                ?>
            </div>
        <?php
    }
?>
<!-- End Content -->
<?php require_once('view/site_layout/sidebar.php'); ?>
<?php require_once('view/site_layout/footer.php'); ?>