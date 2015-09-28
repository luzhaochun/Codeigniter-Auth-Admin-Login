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
        <?php echo bootstrap_url('/bower_components/DataTables/media/js/jquery.dataTables.min.js', 'javascript'); ?>
        <?php echo bootstrap_url('/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js', 'javascript'); ?>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head> 