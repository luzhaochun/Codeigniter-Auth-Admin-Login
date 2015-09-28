$(document).ready(function () {
    $("input[type='checkbox']").selectCheckBox();
    $(".low_level").hide();
    //check all sub checkbox is checked
    if ($("input[type='checkbox']:checked").length == $("input[type='checkbox']").length - 1) {
        $('#check_box').prop('checked', true);
    }
    $(document).on('click', '.collexpa', function () {
        var _target = $(this);
        var _tr_menu = $('table tbody tr');
        var _level = parseInt(_target.parent().parent().attr('data-level'));
        var _origin = _level + 1;
        var current_index = _tr_menu.index(_target.parent().parent());
        if (_target.hasClass('collapser')) {
            for (var i = current_index + 1; i <= _tr_menu.length; i++) {
                if ((_tr_menu.eq(i).attr('data-level') > _level) && (_tr_menu.eq(i).attr('data-level') == _origin))
                    _tr_menu.eq(i).show();
                else if (_tr_menu.eq(i).attr('data-level') <= _level)
                    break;
            }
            _target.removeClass('collapser').addClass('expander');
        } else {
            for (var i = current_index + 1; i <= _tr_menu.length; i++) {
                if ((_tr_menu.eq(i).attr('data-level') > _level))
                    _tr_menu.eq(i).hide();
                else if (_tr_menu.eq(i).attr('data-level') <= _level)
                    break;
            }
            _target.removeClass('expander').addClass('collapser');
        }

    });
    var index = parent.layer.getFrameIndex(window.name);
    $(document).on('click', '.btn_auth_close', function () {
        parent.layer.close(index);
    });
    $(document).on('click','.btn_auth_save',function(){
        $('#myform').submit();
        //parent.layer.close(index);
        
    });
});
var checknode = function(obj) {
    var chk = $("input[type='checkbox']");
    var count = chk.length;
    var num = chk.index(obj);
    var level_top = level_bottom = chk.eq(num).attr('level');
    for (var i = num; i >= 0; i--) {
        var le = chk.eq(i).attr('level');
        if (eval(le) < eval(level_top)) {
            chk.eq(i).prop("checked", true);
            var level_top = level_top - 1;
        }
    }

    for (var j = num + 1; j < count; j++) {
        var le = chk.eq(j).attr('level');
        if (chk.eq(num).is(':checked')) {
            if (eval(le) > eval(level_bottom))
                chk.eq(j).prop("checked", true);
            else if (eval(le) == eval(level_bottom))
                break;
        } else {
            if (eval(le) > eval(level_bottom))
                chk.eq(j).prop("checked", false);
            else if (eval(le) == eval(level_bottom))
                break;
        }
    }
}