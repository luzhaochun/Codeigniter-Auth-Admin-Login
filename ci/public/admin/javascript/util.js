/**
 * Created by timlu on 15/6/17.
 */
//控制全选，反选checkbox进行选择操作
//checkbox 批量处理插件  new
//example:$("input[type='checkbox']").selectCheckBox();

$.fn.selectCheckBox = function () {
    var selectboxs = this;
    return selectboxs.each(function (index) {
        $(this).click(function () {
            if (index == 0 ) {
                if ($(this).is(':checked')) {
                    selectboxs.prop("checked",'checked');
                } else {
                    selectboxs.removeAttr("checked");
                }
            } else {
                if($(this).is(':checked')){
                    var checked_length = $("input[type='checkbox']:checked").length;
                    if(selectboxs.first().prop('checked') == false && (checked_length == selectboxs.length-1 )){
                        selectboxs.first().prop("checked",'checked');
                    }
                }else{
                    selectboxs.first().removeAttr("checked");
                }
            }
        });
    });
};