<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->load->view('public/header');
?>

<body>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>角色</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($list)) {
                                    $i = 0;
                                    foreach ($list as $item) {
                                        ?>
                                        <tr class="<?php echo $i % 2 == 0 ? 'success' : 'info'; ?>">
                                            <td><input disabled type="checkbox" name="xxxx" value="<?php echo $item['id']; ?>"
                                                <?php echo $item['flag'] == 1 ? 'checked' : ''; ?>
                                                       ></td>
                                            <td><?php echo $item['id']; ?></td>
                                            <td><?php echo $item['username']; ?></td>
                                            <td><?php echo $role_list[$item['role']]; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                                <?php if (!empty($pageLinks)) { ?>
                                    <tr> 
                                        <td colspan="5"><?php echo $pageLinks; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</body>
</html>

