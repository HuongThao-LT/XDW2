<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
    <link rel="stylesheet" href="public/css/register.css">
    <title>Đăng ký tài khoản</title>

</head>
<body>
    <form  id="register-form" action="register.php" method="POST">
        <div class="wrapper-container">
            <header>
                <h1>Registration</h1>
            </header>
            <div class="wrapper-form">
                <div class="input-field">
                    <label class="label-primary" for="name">Họ và tên</label>
                    <input type="text" name="name" >
                    <!-- <span class="form-message"></span> -->
                </div>
                <div class="input-field">
                    <label class="label-primary" for="email">Địa chỉ email</label>
                    <input type="email" name="email" >
                    <!-- <span id="form-message-email"></span> -->
                </div>
                <div class="input-field">
                    <label class="label-primary" for="phonenumber">Số điện thoại</label>
                    <input type="text" name="phonenumber" >
                    <!-- <span id="form-message-phone"></span> -->
                </div>
                <div class="input-field">
                    <label class="label-primary" for="username">Username</label>
                    <input type="text" name="username" required>
                    <span id="form-message-username"><?php echo $message ?? ""; ?></span>
                </div>
                <div class="input-field">
                    <label class="label-primary" for="password">Password</label>
                    <input type="password" name="password" >
                    <!-- <span class="form-message"></span> -->
                </div>
                <input type="submit" value="register" class="btn-register" name="action">
            </div>
        </div>
    </form>

    <script>
        $(function() {
            function checkPassword(value, element ) {
                let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#@$!%*?&-])[A-Za-z\d@#$!%*?&-]{8,20}$/;
                return this.optional(element) || pattern.test(value);
            }
            $.validator.addMethod("checkpassword", checkPassword, "Mật khẩu không hợp lệ!");

            $.validator.addMethod("checkName", function(value, element) {
                return (value.trim() == value) && (value.indexOf(" ") > 0);
            }, "Họ và tên không hợp lệ!");

            $("#register-form").validate({
                rules: {
                    name: {
                        required: true,
                        checkName: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phonenumber: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 11
                    },
                    username: {
                        required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                        },
                        minlength: 6,
                        maxlength: 20,
                    },
                    password: {
                        required: true,
                        checkpassword: true,
                    }
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập họ và tên!",
                    },
                    email: {
                        required: "Vui lòng nhập email!",
                        email: "Email không hợp lệ!"

                    },
                    phonenumber: {
                        required: "Vui lòng nhập số điện thoại!",
                        number: "Số điện thoại không hợp lệ!",
                        minlength: "Số điện thoại không hợp lệ!",
                        maxlength: "Số điện thoại không hợp lệ!"
                    },
                    username: {
                        required: "Vui lòng nhập username!",
                        minlength: "Username phải có ít nhất 6 ký tự!",
                        maxlength: "Username tối đa 20 ký tự!"
                    },
                    password: {
                        required: "Vui lòng nhập password!",
                        minlength: "Password phải có ít nhất 8 ký tự!",
                        maxlength: "Password tối đa 20 ký tự!"
                    }
                }
            });
        })
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if(isset($_SESSION['status']) && $_SESSION['status'] != '') {

        ?>
            <script>
                swal({
                    title: "<?Php echo $_SESSION['status']; ?>",
                    text: "<?php echo $_SESSION['status']; ?>",
                    icon: "<?php echo $_SESSION['status_code']; ?>",
                    button: "OK",
                });
                <?php
                if ($_SESSION['status_code'] == 'success') { ?>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 2000);
                <?php
                } ?>
            </script>

        <?php
        unset($_SESSION['status']);
    }
    ?>
</body>
</html>