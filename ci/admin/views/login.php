<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>滚滚红尘--后台登陆</title>
        <!-- Bootstrap Core CSS -->
        <?php echo bootstrap_url('/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>
        <!-- MetisMenu CSS -->
        <?php echo bootstrap_url('/bower_components/metisMenu/dist/metisMenu.min.css'); ?>
        <!-- Timeline CSS -->
        <?php echo bootstrap_url('/dist/css/sb-admin-2.css'); ?>
        <!-- Custom CSS -->
        <?php echo bootstrap_url('/bower_components/fontawesome/css/font-awesome.min.css'); ?>
        <?php echo css_url('/style.css');?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery -->
        <?php echo bootstrap_url('/bower_components/jquery/dist/jquery.min.js', 'javascript'); ?>
        <!-- Bootstrap Core JavaScript -->
        <?php echo bootstrap_url('/bower_components/bootstrap/dist/js/bootstrap.min.js', 'javascript'); ?>
        <!-- Metis Menu Plugin JavaScript -->
        <?php echo bootstrap_url('/bower_components/metisMenu/dist/metisMenu.min.js', 'javascript'); ?>
        <!-- Custom Theme JavaScript -->
        <?php echo bootstrap_url('/dist/js/sb-admin-2.js', 'javascript'); ?>
        <?php echo javascript_url('/jquery.validate.js');?>
        <script type="text/javascript" lang="javascript">
            $(function () {
                $("#frm_login").validate({
                    rules : {
                        username :{
                            required : true
                        },
                        password : {
                            required : true
                        }
                    }
                });
                $("#frm_login").on('click', '#btn_summit', function () {
                    $("#frm_login").submit();    
                })
            })

        </script>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" name="frm_login" id="frm_login" method="post" action="<?php echo site_url('Login/checkLogin'); ?>">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username|Email|Mobile" id="username" name="username" type="input" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" id="password" name="password" type="password" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <a href="javascript:;" id="btn_summit" class="btn btn-lg btn-success btn-block">Login</a>
                                    <div class="login_error"><?php if(!empty($error)){echo $error;};?></div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
