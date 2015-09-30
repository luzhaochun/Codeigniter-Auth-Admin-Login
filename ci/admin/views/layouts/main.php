<?php
$this->load->helper('url');
?>

<!DOCTYPE html><html lang="en">   
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CI框架--个人后台管理</title>
        <!-- Bootstrap Core CSS -->
        <?php echo css_url('/jquery-ui.min.css'); ?>

        <?php echo bootstrap_url('/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>
        <!-- MetisMenu CSS -->
        <?php echo bootstrap_url('/bower_components/metisMenu/dist/metisMenu.min.css'); ?>
        <!-- Timeline CSS -->
        <?php echo bootstrap_url('/dist/css/timeline.css'); ?>
        <!-- Custom CSS -->
        <?php echo bootstrap_url('/dist/css/sb-admin-2.css'); ?>
        <!-- Morris Charts CSS -->
        <?php echo bootstrap_url('/bower_components/morrisjs/morris.css'); ?>
        <!-- Custom Fonts -->
        <?php echo bootstrap_url('/bower_components/fontawesome/css/font-awesome.min.css'); ?>
        <!-- jQuery -->
        <?php echo bootstrap_url('/bower_components/jquery/dist/jquery.min.js', 'javascript'); ?>
        <!-- Bootstrap Core JavaScript -->
        <?php echo bootstrap_url('/bower_components/bootstrap/dist/js/bootstrap.min.js', 'javascript'); ?>
        <!-- Metis Menu Plugin JavaScript -->
        <?php echo bootstrap_url('/bower_components/metisMenu/dist/metisMenu.min.js', 'javascript'); ?>
        <!-- Morris Charts JavaScript -->
        <?php echo bootstrap_url('/bower_components/raphael/raphael-min.js', 'javascript'); ?>
        <!-- Custom Theme JavaScript -->
        <?php echo bootstrap_url('/dist/js/sb-admin-2.js', 'javascript'); ?>
        <?php echo javascript_url('/jquery.validate.js'); ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>   
    <body>                  
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">滚滚红尘后台管理</a>
                </div>
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('user')['username']; ?></a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('Login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav in" id="side-menu">
                            <?php echo $menuList; ?>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div id="page-wrapper">               
                <?php echo $content; ?>
            </div>

        </div>
    </body>
</html>