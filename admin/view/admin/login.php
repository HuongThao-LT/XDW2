<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- <link rel="stylesheet" href="css/login.css" /> -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/nucleo-icons.css" />
    <link rel="stylesheet" href="css/black-dashboard.css" />
    <link rel="stylesheet" href="css/black-dashboard.css.map" />
    <link rel="stylesheet" href="css/black-dashboard.min.css" />
    <link rel="stylesheet" href="css/theme.css" />

    <title><?= $title ?? "Admin - Login" ?></title>

    <!-- JS Cookie -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js" integrity="sha256-0H3Nuz3aug3afVbUlsu12Puxva3CP4EhJtPExqs54Vg=" crossorigin="anonymous"></script>

    <!-- Jquery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Axios Library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="col-md-10 text-center ml-auto mr-auto">
        <h3 class="mb-5">Log in to see how you can speed up your web development with out of the box CRUD for #User Management and more.</h3>
    </div>
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form id="login-admin-form" method="post">
            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="img/card-primary.png">
                    <h1 class="card-title">Admin Login</h1>
                    <span id="login-admin-title-message" style="text-align:center;"></span>
                </div>
                <div class="card-body">
                    <p class="text-dark mb-2">Sign in with <strong>username</strong> and the password <strong>secret</strong></p>
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">

                        <input class="form-control" type=" text" name="username" placeholder="Please enter username..."><br>
                        <span id="login-admin-error-username" class="login-admin-error"></span>
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">

                        <input class="form-control" type="password" name="password" placeholder="Please enter password"><br>
                        <span id="login-admin-error-password" class="login-admin-error"></span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">Login</button>

                </div>
            </div>
        </form>
        <input type="hidden" id="api-url" value="<?= API_URL ?>">
        <input type="hidden" id="app-url" value="<?= APP_URL ?>">
    </div>
    <script src="js/login.js"></script>
    <script src="js/black-dashboard.js"></script>
    <script src="js/black-dashboard.js.map"></script>
    <script src="js/black-dashboard.min.js"></script>
    <script src="js/theme.js"></script>
    <script src="core/bootstrap.min.js"></script>
    <script src="core/jquery.min.js"></script>
    <script src="core/popper.min.js"></script>
</body>

</html>