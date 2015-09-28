<?php echo css_url('/style.css'); ?>
<?php echo javascript_url('/layer/layer.js'); ?>
<?php echo javascript_url('/ui_dialog/jquery-ui.min.js'); ?>
<?php echo javascript_url('/util.js'); ?>
<?php echo javascript_url('/admin/default.js'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">管理员列表</h1>
    </div>
</div>
<div class="col-lg-12">
    <p class="msg <?php //echo $status; ?>"><?php //echo $msg; ?></p>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="button" class="btn btn-info" id="add_role">新增管理员</button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 8%;"><input type="checkbox"/></th>
                            <th>用户名</th>
                            <th>Email</th>
                            <th>手机号码</th>
                            <th>角色名称</th>
                            <th style="width:10%">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($userlist)){
                        $i = 0;
                        foreach ($userlist as $key => $item) {
                            ?>
                            <tr class="<?php echo $i % 2 == 0 ? 'success' : 'info'; ?>">
                                <td><input type="checkbox"/></td>
                                <td><?php echo $item['username']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td>
                                   <?php echo $item['mobile']; ?> 
                                </td>
                                <td>
                                   <?php echo $group[$item['role']];?> 
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm btn_role_edit" data-id="<?php echo $item['id'];?>" >编辑</button>
                                    <button type="button" class="btn btn-danger btn-sm btn_role_del" data-id="<?php echo $item['id'];?>" >删除</button>
                                </td>
                            </tr>
                            <?php $i++;
                        } } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<div id="dialog-form" title="新增管理员" style="display:none;">
    <p class="validateTips"></p>
    <div class="widget-content padded">
        <form style="margin-left:50px;margin-top:30px;" action="<?php echo site_url('Admin/add');?>" class="form-horizontal" method="POST" name="frm_menu" id="frm_menu">
            <div class="form-group">
                <label class="control-label col-md-3">管理员名称：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="管理员名称" type="text" name="username" id="username">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3">Email：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="Email" type="text" name="email" id="email">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3">手机号码：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="手机号码" type="text" name="mobile" id="mobile">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3">角色名称：</label>
                <div class="col-md-7">
                    <div style="padding-top: 7px;">
                        <select name="role" id="role" style="width: 308px;">
                            
                            <?php foreach($group as $key => $item){ ?>
                                <option value="<?php echo $key;?>"><?php echo $item;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">密码：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="密码" type="password" name="password" id="password">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">确认密码：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="确认密码" type="password" name="confrim_password" id="confrim_password">
                </div>
            </div>

        </form>
    </div>
</div>


<div id="dialog-edit-form" title="编辑管理员" style="display:none;">
    <p class="validateTips"></p>
    <div class="widget-content padded">
        <form style="margin-left:50px;margin-top:30px;" action="<?php echo site_url('Admin/edit');?>" class="form-horizontal" method="POST" name="frm_edit_admin" id="frm_edit_admin">
            <div class="form-group">
                <label class="control-label col-md-3">管理员名称：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="管理员名称" type="text" name="username" id="username">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3">Email：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="Email" type="text" name="email" id="email">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3">手机号码：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="手机号码" type="text" name="mobile" id="mobile">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3">角色名称：</label>
                <div class="col-md-7">
                    <div style="padding-top: 7px;">
                        <select name="role" id="role" style="width: 308px;">
                            
                            <?php foreach($group as $key => $item){ ?>
                                <option value="<?php echo $key;?>"><?php echo $item;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">密码：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="密码" type="password" name="password" id="password">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">确认密码：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="确认密码" type="password" name="confrim_password" id="confrim_password">
                </div>
            </div>
            <input type="hidden" id="id" name="id"  value="" />
        </form>
    </div>
</div>

<div id="div_hide">
    <input type="hidden" name="getAdminInfoByIdUrl" id="getAdminInfoByIdUrl" value="<?php echo site_url('Admin/getAdminInfoById'); ?>" />
    <input type="hidden" name="delAdminUrl" id="delAdminUrl" value="<?php echo site_url('Admin/del'); ?>" />
</div>