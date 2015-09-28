$(function () {
    $('#dialog').hide();
    var header_height = $("#header").height();
    var document_height = $(window).height();
    $('#main #div_banner img').css('height', document_height - header_height + $("#div_content_title").height());
    $(document).on('click', '#drugstore_cop', function () {
        $('#dialog').show();
    });
    $.scrollify({
        section: ".panel"
    });

    $('#frm_apply').on('click', '#btn_sub', function () {
        if ($('#drugstore_name').val().trim() == '') {
            alert('请输入药店名称');
            return false;
        }
        if ($("#province").val() == "" || $('#city').val() == "") {
            alert('请选择所在城市');
            return false;
        }
        if ($("#contact_name").val().trim() == "") {
            alert('请输入联系人');
            return false;
        }
        if ($("#contact_phone").val().trim() == "") {
            alert('请输入联系电话');
            return false;
        }
    })
});

