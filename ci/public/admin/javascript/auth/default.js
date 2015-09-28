/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    var addRoleUrl = $("#div_hide #addRoleUrl").val();
    var editRoleUrl = $("#div_hide #editRoleUrl").val();
    var checkRoleNameUniqueUrl = $("#div_hide #checkRoleNameUnique").val();
    var getRoleInfoUrl = $("#div_hide #getRoleInfo").val();
    var delRoleUrl = $("#div_hide #delRoleUrl").val();
    var scanAdminUrl = $("#div_hide #scanAdminUrl").val();
    var authListUrl = $("#div_hide #authListUrl").val();
    $("input[type='checkbox']").selectCheckBox();
    //add new role
    $("#add_role").button().click(function () {
        $("#dialog-form #frm_group").prop('action', addRoleUrl);
        $("#div_hide #form_type").val('add');
        $("#dialog-form #frm_group")[0].reset();
        $("#dialog-form #frm_group #title").next('label').css('display', 'none');
        $("#frm_group #id").val('');
        $("#dialog-form").dialog("open");
    });

    $(document).on('click', '.btn_role_edit', function () {
        $("#dialog-form #frm_group").prop('action', editRoleUrl);
        $("#div_hide #form_type").val('edit');
        $("#dialog-form #frm_group")[0].reset();
        $.ajax({
            url: getRoleInfoUrl,
            data: {id: $(this).attr("data-id")},
            dataType: 'json',
            success: function (rtn) {
                if (typeof rtn.id != 'undefined') {
                    $("#frm_group #title").val(rtn.title);
                    $("#frm_group #id").val(rtn.id);
                    $("#dialog-form").dialog("open");
                } else {
                    layer.confirm('网络错误，确认刷新页面吗？', {icon: 5}, function (index) {
                        window.location.reload();
                    });
                }
            }
        });
    });

    $(document).on('click', ".btn_role_del", function () {
        var _id = $(this).attr("data-id");
        layer.confirm('确认删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = delRoleUrl + "?id=" + _id;
        });
    });

    $("#dialog-form").dialog({
        autoOpen: false,
        height: 200,
        width: 350,
        modal: true,
        buttons: {
            "保存": function () {
                $("#frm_group").submit();
            },
            取消: function () {
                $(this).dialog("close");
            }
        }
    });

    $("#frm_group").validate({
        rules: {
            title: {
                required: true,
                remote: {
                    url: checkRoleNameUniqueUrl,
                    type: "get",
                    dataType: "json",
                    data: {
                        title: function () {
                            return $("#title").val();
                        },
                        type: function () {
                            return $("#form_type").val();
                        },
                        id: function () {
                            return $("#frm_group #id").val();
                        }
                    }
                }
            }
        },
        messages: {
            title: {
                required: "角色名称不为空",
                remote: '该角色名称已存在，请重新输入'
            }
        }
    });
    $(document).on('click', '.btn_scan_admin', function () {
        var _id = $(this).attr('data-id');
        layer.open({
            title : '成员列表',
            type: 2,
            area: ['800px', '500px'],
            fix: false, //不固定
            maxmin: true,
            content: scanAdminUrl+"?id="+_id
        });
    });
    $(document).on('click','.btn_select_auth',function(){
        var _id = $(this).attr('data-id');
        layer.open({
            title : '权限列表',
            type : 2,
            area : ['800px','600px'],
            fix : false,
            maxmin:true,
            content : authListUrl + "?id="+_id
        });
    });
   
});