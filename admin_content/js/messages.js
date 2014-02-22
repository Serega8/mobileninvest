$(document).ready(function() {
    $('.list_cat table tr').hover(function () {
       $(this).addClass('hover_tr'); 
    },function() {
        $(this).removeClass('hover_tr');
    });
    $('.check-all').change(function() {
        var _type = $(this).attr('d-type');
        var cls;
        var msgpr;
        switch (_type) {
            case 'products':
                cls = 'change-msg-products';
                msgpr = 'msg_pr_';
                txt = '#sel-prod';
                break;
            default:
                msgpr = 'msg_';
                txt = '#sel-msg-all'
                cls = 'change-msg';
                break;
        }
        var all = document.getElementsByClassName(cls);
        var self = $(this);
        var txt = $(txt);
        if (self.val() == 'true') {
            self.val('false');
            txt.text('отметить все');
            for (var i = 0; i < all.length; i++) {
                var id = all[i].getAttribute('data-id');
                all[i].setAttribute('val', 'false');
                $('#' + msgpr + id).removeClass('choose');;
                all[i].checked = false;

            }
        }
        else {
            self.val('true');
            txt.text('снять все');
            for (var i = 0; i < all.length; i++) {
                var id = all[i].getAttribute('data-id');
                all[i].setAttribute('val', 'true');
                $('#' + msgpr + id).addClass('choose');
                all[i].checked = true;
            }
        }
    });
    $('.change-msg').change(function() {
        var _type = $(this).attr('d-type');
        var cls;
        var msgpr;
        switch (_type) {
            case 'products':
                cls = 'change-msg-products';
                msgpr = 'msg_pr_';
                break;
            default:
                msgpr = 'msg_';
                cls = 'change-msg';
                break;
        }
        var id = $(this).attr('data-id');
        var attr = $(this);
        switch (attr.attr('val')) {
            case 'false':
                $('#' + msgpr + id).addClass('choose');
                attr.attr('val', 'true');
                break;
            case'true':
                $('#' + msgpr + id).removeClass('choose');
                attr.attr('val', 'false');
                break;
            default:
                break;
        }
        console.log(id);

    });
    $('.change-msg-products').change(function() {
        var id = $(this).attr('data-id');
        var attr = $(this);
        switch (attr.attr('val')) {
            case 'false':
                $('#msg_pr_' + id).addClass('choose');
                attr.attr('val', 'true');
                break;
            case'true':
                $('#msg_pr_' + id).removeClass('choose');
                
                attr.attr('val', 'false');
                break;
            default:
                break;
        }
        console.log(id);

    });




    $('.select-msg').change(function() {
        var t_type = $(this).attr('data-type');
        var cls;
        switch (t_type) {
            case 'products':
                cls = 'change-msg-products';
                msgpr = 'msg_pr_';
                break;
            default:
                msgpr = 'msg_';
                cls = 'change-msg';
                break;
        }
        var self = $(this);
        var arr = new Array();
        var all = document.getElementsByClassName(cls);

        var data = new FormData();
        for (var i = 0; i < all.length; i++) {
            if (all[i].checked) {
                arr.push(all[i].getAttribute('data-id'));
            }
        }
        data.append('ids', arr);
        data.append('typeOfPage', t_type);
        switch (self.val()) {
            case 'delete':
                data.append('type', 'delete');
                break;
            case 'read':
                data.append('type', 'read');
                break;
            case 'hide':
                data.append('type', 'hide');
                break;
            case 'show':
                data.append('type', 'show');
                break;
            default:
                return false;
                break;
        }


        if (arr.length) {
            var request = new getXHR();
            if (request) {
                var url = "/admin/set_msg_status";
                request.open("POST", url, true);

                request.onload = function(e) {
                    console.log(request.responseText);
                    reload_page();
                }
                request.onerror = function(e) {
                    console.log(request.responseText);
                    reload_page();
                }
                request.send(data);
            }
            else {
                alert('Не поддерживается браузер');
            }
        }

    });
    function reload_page() {
        window.location.reload();
    }

    function getXHR() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        }
        try {
            return new ActiveXObject('MSXML2.XMLHTTP.6.0');
        } catch (e) {
            try {
                return new ActiveXObject('MSXML2.XMLHTTP.3.0');
            } catch (e) {
                return null;
            }
        }
    }
});