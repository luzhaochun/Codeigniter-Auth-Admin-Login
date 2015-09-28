<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Server Imformation</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- /.row -->

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Context Classes
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 50%;">Server Variables</th>
                            <th>Values</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="success">
                            <td>PHP Version</td>
                            <td><?php echo PHP_VERSION; ?></td>
                            
                        </tr>
                        <tr class="info">
                            <td>Zend Version</td>
                            <td><?php echo zend_version(); ?></td>
                        </tr>
                        <tr class="success">
                            <td>Mysql Support</td>
                            <td><?php echo function_exists('mysql_close')?"Yes":"No"; ?></td>
                            
                        </tr>
                        <tr class="info">
                            <td>Mysql Allow Persistent</td>
                            <td><?php echo @get_cfg_var("mysql.allow_persistent")?"Yes":"No"; ?></td>
                        </tr>
                        <tr class="success">
                            <td>Mysql Max Links</td>
                            <td><?php echo @get_cfg_var("mysql.max_links")==-1 ? "Unlimited" : @get_cfg_var("mysql.max_links"); ?></td>
                            
                        </tr>
                        <tr class="info">
                            <td>Operate System</td>
                            <td><?php echo PHP_OS; ?></td>
                        </tr>
                        <tr class="success">
                            <td>Max Upload File Size</td>
                            <td><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"Not Allowed"; ?></td>
                            
                        </tr>
                        <tr class="info">
                            <td>Max Execution Time</td>
                            <td><?php echo get_cfg_var("max_execution_time")." Sec"; ?></td>
                        </tr>
                        <tr class="success">
                            <td>Memory Limit</td>
                            <td><?php echo get_cfg_var("memory_limit")?get_cfg_var("memory_limit"):"N/A" ?></td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>