/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    var getAdminInfoUrl = $("#div_hide #getAdminInfoByIdUrl").val();
    var delAdminUrl = $("#div_hide #delAdminUrl").val();
    $("input[type='checkbox']").selectCheckBox();
    //add new role
    $("#add_role").button().click(function () {
        $("#dialog-form").dialog({
            autoOpen: true,
            height: 500,
            width: 700,
            modal: true,
            buttons: {
                "保存": function () {
                    $("#frm_menu").submit();
                },
                取消: function () {
                    $(this).dialog("close");
                }
            }
        });
    });

    $(document).on('click', '.btn_role_edit', function () {
        $("#dialog-edit-form #frm_edit_admin")[0].reset();
        $.ajax({
            url: getAdminInfoUrl,
            data: {id: $(this).attr("data-id")},
            dataType: 'json',
            success: function (rtn) {
                if (typeof rtn.id != 'undefined') {
                    $("#frm_edit_admin #username").val(rtn.username);
                    $("#frm_edit_admin #email").val(rtn.email);
                    $("#frm_edit_admin #mobile").val(rtn.mobile);
                    $("#frm_edit_admin #role").val(rtn.role);
                    $("#frm_edit_admin #id").val(rtn.id);
                    $("#dialog-edit-form").dialog({
                        autoOpen: true,
                        height: 500,
                        width: 700,
                        modal: true,
                        buttons: {
                            "保存": function () {
                                $("#frm_edit_admin").submit();
                            },
                            取消: function () {
                                $(this).dialog("close");
                            }
                        }
                    });
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
            window.location.href = delAdminUrl + "?id=" + _id;
        });
    });



    $("#frm_menu").validate({
        rules: {
            username: {
                required: true,
//                remote: {
//                    url: checkRoleNameUniqueUrl,
//                    type: "get",
//                    dataType: "json",
//                    data: {
//                        title: function () {
//                            return $("#title").val();
//                        },
//                        type: function () {
//                            return $("#form_type").val();
//                        },
//                        id: function () {
//                            return $("#frm_group #id").val();
//                        }
//                    }
//                }
            }
        },
        messages: {
            username: {
                required: "管理员名称不为空",
                //remote: '该角色名称已存在，请重新输入'
            }
        }
    })
})