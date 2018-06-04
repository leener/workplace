
{__NOLAYOUT__}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="__STATIC__/admin/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="__STATIC__/plugins/iCheck/square/blue.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html">用户注册</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">注册新账户</p>

            <form action="{:url('Login/create')}" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="用户名" name="username">
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="邮箱" name="email">
                    <span class="fa fa-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="密码" name="password">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="确认密码" name="repassword">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">注册</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a href="login.html" class="text-center">已经拥有账户</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="__STATIC__/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="__STATIC__/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="__STATIC__/plugins/iCheck/icheck.min.js"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass   : 'iradio_square-blue',
            increaseArea : '20%' // optional
        })
    })
</script>
</body>
</html>
