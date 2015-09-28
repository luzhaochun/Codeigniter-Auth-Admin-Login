<?php echo css_url('/style.css'); ?>
<?php echo javascript_url('/layer/layer.js'); ?>
<?php echo javascript_url('/ui_dialog/jquery-ui.min.js'); ?>
<?php echo javascript_url('/util.js'); ?>
<?php echo javascript_url('/auth/default.js'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">角色列表</h1>
    </div>
</div>
<div class="col-lg-12">
    <p class="msg <?php echo $status; ?>"><?php echo $msg; ?></p>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="button" class="btn btn-info" id="add_role">新增角色</button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 8%;"><input type="checkbox"/></th>
                            <th>角色名称</th>
                            <th>角色状态</th>
                            <th>成员列表</th>
                            <th>权限列表</th>
                            <th style="width:10%">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($list as $key => $item) {
                            ?>
                            <tr class="<?php echo $i % 2 == 0 ? 'success' : 'info'; ?>">
                                <td><input type="checkbox"/></td>
                                <td><?php echo $item['title']; ?></td>
                                <td><?php echo $item['status'] == 1 ? '启用' : '禁止'; ?></td>
                                <td>
                                    <button type="button" data-id="<?php echo $item['id'];?>" class="btn btn-primary btn-xs btn_scan_admin">查看成员</button>
                                </td>
                                <td>
                                    <button type="button" data-id="<?php echo $item['id'];?>" class="btn btn-primary btn-xs btn_select_auth" btn_scan_rule>选择权限</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm btn_role_edit" data-id="<?php echo $item['id'];?>" >编辑</button>
                                    <button type="button" class="btn btn-danger btn-sm btn_role_del" data-id="<?php echo $item['id'];?>" >删除</button>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<div id="dialog-form" title="新增|编辑角色" style="display:none;">
    <p class="validateTips"></p>
    <form id="frm_group" name="frm_group" action="<?php echo site_url('AuthGroup/addRole'); ?>" method="POST" >
        <fieldset>
            <label for="name">角色名称：</label>
            <input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all" />
            <label for="title" class="error" style="margin-left: 80px;font-size: 4px;"></label>
            <input type="hidden" name="id" id="id" value=""/>
        </fieldset>
    </form>
</div>


<div id="div_hide">
    <input type="hidden" name="checkRoleNameUnique" id="checkRoleNameUnique" value="<?php echo site_url('AuthGroup/checkRoleNameUnique'); ?>" />
    <input type="hidden" name="form_type" id="form_type" value="add" />
    <input type="hidden" name="editRoleUrl" id="editRoleUrl" value="<?php echo site_url('AuthGroup/editRole'); ?>" />
    <input type="hidden" name="addRoleUrl" id="addRoleUrl" value="<?php echo site_url('AuthGroup/addRole'); ?>" />
    <input type="hidden" name="getRoleInfo" id="getRoleInfo" value="<?php echo site_url('AuthGroup/getRoleInfo'); ?>" />
    <input type="hidden" name="delRoleUrl" id="delRoleUrl" value="<?php echo site_url('AuthGroup/delRole'); ?>" />
    <input type="hidden" name="scanAdminUrl" id="scanAdminUrl" value="<?php echo site_url('AuthGroup/scanAdmin'); ?>" />
    <input type="hidden" name="authListUrl" id="authListUrl" value="<?php echo site_url('AuthGroup/authList'); ?>" />
</div>