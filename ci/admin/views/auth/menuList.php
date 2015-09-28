<?php echo css_url('/style.css'); ?>
<?php echo javascript_url('/layer/layer.js'); ?>
<?php echo javascript_url('/ui_dialog/jquery-ui.min.js'); ?>
<?php echo javascript_url('/jquery.validate.js');?>
<?php echo javascript_url('/auth/menu.js'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">菜单列表</h1>
    </div>
</div>
<div class="col-lg-12">
    <p class="msg <?php //echo $status;  ?>"><?php //echo $msg;  ?></p>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        
        <div class="panel-heading">
            <button type="button" class="btn btn-info" id="add_menu">新增菜单</button>
        </div>
        
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 8%;">排序</th>
                            <th>ID</th>
                            <th>名称</th>
                            <th>标题</th>
                            <th>状态</th>
                            <th style="width:15%">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($list)) {
                            $i = 0;
                            foreach ($list as $key => $item) {
                                ?>
                                <tr class="<?php echo $i % 2 == 0 ? 'success' : 'info'; ?>">
                                    <td><?php echo $item['sort']; ?></td>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['nodeName']; ?></td>
                                    <td>
                                        <?php echo $item['display'] == 1 ? '显示' : '隐藏'; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm btn_menu_add_sub" data-id="<?php echo $item['id']; ?>" >添加子菜单</button>
                                        <button type="button" class="btn btn-success btn-sm btn_menu_edit" data-id="<?php echo $item['id']; ?>" >编辑</button>
                                        <button type="button" class="btn btn-danger btn-sm btn_menu_del" data-id="<?php echo $item['id']; ?>" >删除</button>
                                    </td>
                                </tr>
                                <?php $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<div id="dialog-form" title="新增菜单" style="display:none;">
    <p class="validateTips"></p>
    <div class="widget-content padded">
        <form style="margin-left:50px;margin-top:30px;" action="<?php echo site_url('AuthGroup/addMenu');?>" class="form-horizontal" method="POST" name="frm_menu" id="frm_menu">
            <div class="form-group">
                <label class="control-label col-md-3">名&nbsp;称：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="请输入名称" type="text" name="name" id="name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">标题：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="请输入标题" type="text" name="title" id="title">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">状态：</label>
                <div class="col-md-7">
                    <label class="radio-inline"><input checked name="display" type="radio" value="1"><span>显示</span></label>
                    <label class="radio-inline"><input name="display" type="radio" value="0"><span>隐藏</span></label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">排序：</label>
                <div class="col-md-7">
                    <input class="form-control" style="width: 33%;" placeholder="0" type="text" name="sort" id="sort">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">ICON样式：</label>
                <div class="col-md-7">
                    <input class="form-control" style="width: 80%;" placeholder="" type="text" name="icon_class" id="icon_class">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">选择父类：</label>
                <div class="col-md-7">
                    <div style="padding-top: 7px;">
                        <select name="parent_id" id="parent_id" style="width: 308px;">
                            <option value="0">第一层目录</option>
                            <?php foreach($list as $item){ ?>
                                <option value="<?php echo $item['id'];?>"><?php echo $item['nodeName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="dialog-edit-form" title="编辑菜单" style="display:none;">
    <p class="validateTips"></p>
    <div class="widget-content padded">
        <form style="margin-left:50px;margin-top:30px;" action="<?php echo site_url('AuthGroup/EditMenu');?>" class="form-horizontal" method="POST" name="frm_edit_menu" id="frm_edit_menu">
            <div class="form-group">
                <label class="control-label col-md-3">名&nbsp;称：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="请输入名称" type="text" name="name" id="name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">标题：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="请输入标题" type="text" name="title" id="title">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">状态：</label>
                <div class="col-md-7">
                    <label class="radio-inline"><input id="display_on" name="display" type="radio" value="1"><span>显示</span></label>
                    <label class="radio-inline"><input id="display_off" name="display" type="radio" value="0"><span>不显示</span></label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">排序：</label>
                <div class="col-md-7">
                    <input class="form-control" style="width: 33%;" placeholder="0" type="text" name="sort" id="sort">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3">ICON样式：</label>
                <div class="col-md-7">
                    <input class="form-control" style="width: 80%;" placeholder="" type="text" name="class" id="class">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3">选择父类：</label>
                <div class="col-md-7">
                    <div style="padding-top: 7px;">
                        <select name="parent_id" id="parent_id" style="width: 308px;">
                            <option value="0">第一层目录</option>
                            <?php foreach($list as $item){ ?>
                                <option value="<?php echo $item['id'];?>"><?php echo $item['nodeName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <input type="hidden" name="id" id="id" value=""/>
            </div>
        </form>
    </div>
</div>

<div id="dialog-sub-form" title="新增子菜单" style="display:none;">
    <p class="validateTips"></p>
    <div class="widget-content padded">
        <form style="margin-left:50px;margin-top:30px;" action="<?php echo site_url('AuthGroup/addMenu');?>" class="form-horizontal" method="POST" name="frm_sub_menu" id="frm_sub_menu">
            <div class="form-group">
                <label class="control-label col-md-3">名&nbsp;称：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="请输入名称" type="text" name="name" id="name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">标题：</label>
                <div class="col-md-7">
                    <input class="form-control" placeholder="请输入标题" type="text" name="title" id="title">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">状态：</label>
                <div class="col-md-7">
                    <label class="radio-inline"><input checked name="display" type="radio" value="1"><span>显示</span></label>
                    <label class="radio-inline"><input name="display" type="radio" value="0"><span>隐藏</span></label>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">排序：</label>
                <div class="col-md-7">
                    <input class="form-control" style="width: 33%;" placeholder="0" type="text" name="sort" id="sort">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">ICON样式：</label>
                <div class="col-md-7">
                    <input class="form-control" style="width: 80%;" placeholder="" type="text" name="icon_class" id="icon_class">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">选择父类：</label>
                <div class="col-md-7">
                    <div style="padding-top: 7px;">
                        <select name="parent_id" id="parent_id" style="width: 308px;">
                            <option value="0">第一层目录</option>
                            <?php foreach($list as $item){ ?>
                                <option value="<?php echo $item['id'];?>"><?php echo $item['nodeName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="div_hide">
    <input type="hidden" name="checkMenuModuleUnique" id="checkMenuModuleUnique" value="<?php echo site_url('AuthGroup/checkMenuModuleUnique'); ?>" />
    <input type="hidden" name="getMenuInfoByIdUrl" id="getMenuInfoByIdUrl" value="<?php echo site_url('AuthGroup/getMenuInfoById'); ?>" />
    <input type="hidden" name="delMenuUrl" id="delMenuUrl" value="<?php echo site_url('AuthGroup/delMenu'); ?>" />
</div>