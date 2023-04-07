        </section>
        <div id="manager">
            <?php 
                if (Session::get('login_user') == true) {
                    $cart->display();
                } else {
                    require('view/login/login.php');
                }
            ?>
        </div>
    </div>