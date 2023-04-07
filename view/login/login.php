        <form method="POST" id="login-signup-form">
            <div>
                <div id="login-title">
                    <h3>Login</h3>
                    <span class="text-danger d-block text-center" style="font-size: 13px;" id="login-title-message"><?=$login_message ?? ''?></span>
                </div>
                <div id="login-form">
                    <div class="form-group">
                        <label for="login-username">Username:</label>
                        <input type="text" name="username" id="login-username" placeholder="Please enter username..."><br>
                        <span class="text-danger login-error" style="font-size: 12px;" id="login-username-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="login-password">Password:</label>
                        <input type="password" name="password" id="login-password" placeholder="Please enter password..." autocomplete="off"><br>
                        <span class="text-danger login-error" style="font-size: 12px;" id="login-password-error"></span>
                    </div>
                </div>
                <div id="login-button">
                    <button type="submit">Login</button>
                </div>
            </div>
            <div id="signup-button">
                <label for="signup-title">Don't have account?</label>
                <a href="<?=APP_URL?>register.php" >SignUp</a>
            </div>
        </form>
        <script src="public/js/sidebar.js"></script>

