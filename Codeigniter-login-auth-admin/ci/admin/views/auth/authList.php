<?php $this->load->view('public/header');?>
<?php echo css_url('/style.css'); ?>
<?php echo javascript_url('/layer/layer.js'); ?>
<?php echo javascript_url('/util.js'); ?>
<?php echo javascript_url('/auth/authList.js'); ?>
<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <form name="myform" action="<?php echo site_url('Authgroup/editAuth');?>" method="post" id="myform">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th style='padding-left:30px;width: 90px;'><input type="checkbox" id="check_box"/>全选</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($list as $vo){ ?>
                                    <tr data-child="<?php echo $vo['hasChild'];?>" <?php echo $vo['level'] == 0 ? "class=\"top_level\"" : "class=\"low_level\"";?> data-level="<?php echo $vo['level'];?>">
                                        <td style='padding-left:<?php echo (30+$vo['level']*30);?>px;'> 
                                            <span style="padding-left: 20px" class="collexpa <?php if($vo['hasChild']>0) echo "collapser";?>"></span>
                                            <input <?php echo !empty($vo['flag']) ? 'checked':''; ?> type='checkbox' name='addRuleIds[]' value="<?php echo $vo['id'];?>"
                                            level="<?php echo $vo['level'];?>"
                                            <?php if(!empty($vo['flag'])){ echo " checked";} ?>
                                            onclick='javascript:checknode(this);'><?php echo $vo['nodeName'];?>
                                            <input type='hidden' name='allRuleIds[]' value='<?php echo $vo['id'];?>'>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    
                                    <tr>
                                        <td colspan="2" class="aui_footer">
                                            <div></div>
                                            <div style="float:right;" class="aui_buttons">
                                                <input type="hidden" value="<?php echo $id;?>" id="id" name="id" />
                                                <button type="button" class="btn btn-success btn-sm btn_auth_save">确定</button>
                                                <button type="button" class="btn btn-danger btn-sm btn_auth_close">关闭</button>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                        </form>    
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

