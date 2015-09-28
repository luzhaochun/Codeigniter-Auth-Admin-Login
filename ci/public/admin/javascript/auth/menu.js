/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    var getMenuInfoByIdUrl = $('#div_hide #getMenuInfoByIdUrl').val();
    var delMenuUrl = $('#div_hide #delMenuUrl').val();
    $("#add_menu").button().click(function () {
        $("#dialog-form").dialog({
            autoOpen: true,
            height: 500,
            width: 600,
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

    $(".btn_menu_edit").click(function () {
        $.ajax({
            url: getMenuInfoByIdUrl,
            data: {id: $(this).attr('data-id')},
            dataType: 'json',
            success: function (rtn) {
                if (typeof (rtn.id) != "undefined") {
                    $("#dialog-edit-form #name").val(rtn.name);
                    $("#dialog-edit-form #title").val(rtn.title);
                    $("#dialog-edit-form #sort").val(rtn.sort);
                    $("#dialog-edit-form #class").val(rtn.class);
                    if (rtn.display == 1) {
                        $("#dialog-edit-form #display_on").prop('checked', true);
                    } else {
                        $("#dialog-edit-form #display_off").prop('checked', true);
                    }
                    $("#dialog-edit-form #parent_id").val(rtn.parent_id);
                    $("#dialog-edit-form #id").val(rtn.id);
                    $("#dialog-edit-form").dialog({
                        autoOpen: true,
                        height: 500,
                        width: 600,
                        modal: true,
                        buttons: {
                            "保存": function () {
                                $("#frm_edit_menu").submit();
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
                return;
            }
        });
    });

    $("#frm_menu").validate({
        rules: {
            name: {
                required: true,
//                remote: {
//                    url: checkMenuModuleUniqueUrl,
//                    type: "post",
//                    dataType: "json",
//                    data: {
//                        module: function () {
//                            return $("#module").val();
//                        },
//                        type: 'add'
//                    }
//
//                }
            },
            title: {
                required: true
            },
            sort: {
                required: true,
                digits: true
            }
        },
        messages: {
            name: {
                required: "名称不为空",
                // remote: '该名称已存在，请重新输入'
            },
            title: {
                required: "标题不为空",
            },
            sort: {
                required: "排序不为空",
                digits: "排序请输入正整数"
            }
        }
    });


    $("#frm_edit_menu").validate({
        rules: {
            name: {
                required: true,
//                remote: {
//                    url: checkMenuModuleUniqueUrl,
//                    type: "post",
//                    dataType: "json",
//                    data: {
//                        module: function () {
//                            return $("#module").val();
//                        },
//                        type: 'add'
//                    }
//
//                }
            },
            title: {
                required: true
            },
            sort: {
                required: true,
                digits: true
            }
        },
        messages: {
            name: {
                required: "名称不为空",
                // remote: '该名称已存在，请重新输入'
            },
            title: {
                required: "标题不为空",
            },
            sort: {
                required: "排序不为空",
                digits: "排序请输入正整数"
            }
        }
    });

    //delete menu
    $(document).on('click', ".btn_menu_del", function () {
        var _target = $(this);
        layer.confirm('确定删除该菜单吗？', {icon: 2}, function (index) {
            $.ajax({
                url: delMenuUrl,
                data: {id: _target.attr("data-id")},
                type: "get",
                dataType: "json",
                success: function (rtn) {
                    if (rtn == 1) {
                        layer.msg('删除成功!');
                        window.location.reload();
                    } else {
                        layer.msg('删除失败!');
                    }
                }
            });
        });
        
    });
    
    $(document).on('click','.btn_menu_add_sub',function(){
        var menu_id = $(this).attr('data-id');
        $("#dialog-sub-form #parent_id").val(menu_id);
        $("#dialog-sub-form").dialog({
            autoOpen: true,
            height: 500,
            width: 600,
            modal: true,
            buttons: {
                "保存": function () {
                    $("#frm_sub_menu").submit();
                },
                取消: function () {
                    $(this).dialog("close");
                }
            }
        });
    });
});