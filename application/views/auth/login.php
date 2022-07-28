<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Admin-Mang.App</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url() . "assets/" ?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url() . "assets/" ?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url() . "assets/" ?>plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url() . "assets/" ?>css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>MANG</b></a>
            <small>Selamat datang di halaman Admin</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Masukan Email & Password untuk melanjutkan</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-12">
                            <button class="btn btn-block bg-pink waves-effect" id="btn_login" type="submit">SIGN IN</button>
                        </div>
                        <div class="col-xs-12">
                            <div class="alert alert-warning" style="display: none;">
                                Better check yourself, you're not looking too good.
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url() . "assets/" ?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url() . "assets/" ?>plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url() . "assets/" ?>plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url() . "assets/" ?>plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url() . "assets/" ?>js/admin.js"></script>
    <script src="<?php echo base_url() . "assets/" ?>js/pages/examples/sign-in.js"></script>
    <!-- SweetAlert Plugin Js -->

    <script type="text/javascript">
        $(document).on("submit", "#sign_in", function(e) {
            e.preventDefault();
            var user_email = $("#user_email").val();
            var user_password = $("#user_password").val();
            var form = $("#sign_in").serializeArray();

            $.ajax({
                url: "<?php echo base_url() . "login_post" ?>",
                data: form,
                method: "POST",
                beforeSend: function() {
                    $("#btn_login").attr("disabled", true);
                    $("#btn_login").html("Loading...");
                    $(".alert-warning").fadeOut(100);
                },
                success: function(data) {
                    console.log(data);
                    $("#btn_login").attr("disabled", false);
                    $("#btn_login").html("SIGN IN");
                    var json = $.parseJSON(data);
                    if (json.success == 0) {
                        $(".alert-warning").fadeIn(500);
                        $(".alert-warning").html(json.message);
                    } else {
                        window.location.reload();
                    }

                },
                error: function(xhr) { // if error occured
                    console.log(xhr);

                    $("#btn_login").attr("disabled", false);
                    $("#btn_login").html("SIGN IN");
                    $(".alert-warning").fadeIn(500);
                    $(".alert-warning").html("Error From Server");
                }
            });



        });
    </script>

</body>

</html>