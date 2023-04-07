
            <div id="manager__title">
                <div id="welcom-name">Welcome <?=$_SESSION['login_user_username']?></div>
                <div id="logout-button"><button id="user-logout">Logout</button></div>
            </div>
            <?php
                if($cart->isEmpty()) {
                    ?>
                        <div style="text-align:center; height: 100%">
                            <p style="margin-top: 20px">NO PRODUCTS IN CART</p>
                        </div>
                    <?php
                } else {
                    ?>
                        <form id="cart-form" method="POST">
                            <div id="list-item">
                                <?php $cart->displayLines() ?>
                            </div>
                            <div id="cart-total">
                                <div class="cart-subtotal">
                                    <div class="subtotal-name">Subtotal:</div>
                                    <div class="subtotal-price"><?=$cart->getSubTotalView()?></div>
                                </div>
                                <div class="cart-shipfee">
                                    <div class="shipfee-name">Shipping fee:</div>
                                    <div class="shipfee-price"><?=$cart->getShippingFeeView()?></div>
                                </div>
                                <div class="cart-total">
                                    <div class="total-name">TOTAL:</div>
                                    <div class="total-price"><?=$cart->getTotalView()?></div>
                                </div>
                            </div>
                            <div id="cart-button">
                                <button onclick="cartUpdate()" id="cart-update">UPDATE</button>
                                <button onclick="emptyCart()" id="cart-empty">EMPTY CART</button>
                                <button>ORDER DETAIL</button>
                                <button id="cart-checkout">CHECKOUT</button>
                            </div>
                        </form>
                    <?php
                }
            ?>
            <script src="public/js/sidebar.js"></script>

