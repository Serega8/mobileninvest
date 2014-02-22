$(document).ready(function() {
    $('#edit_currency').delegate('.delete-item-curr', 'click', function() {
        var uid = $(this).attr('data-id');
        var curr_status = $('#curr_name_' + uid).attr('data-status');
        var self = $('#curr_name_' + uid);
        var self_tr = $('#currency_id_' + uid);
        switch (curr_status) {
            case '0':
                self.attr('data-status', '3');
                self_tr.css('opacity', '0.3');
                $(this).text('Восстановить');
                break;
            case '3':
                self.attr('data-status', '0');
                self_tr.css('opacity', '1');
                $(this).text('Удалить');
                break;
            default:
                break;
        }

    });
    $('#add_item_currency').click(function() {
        var datetime = Math.round(new Date());
        $('.currency_tr_name').append("<tr id='currency_id_" + datetime + "'>" +
                "<td>" +
                "<input class='new_name_curr currency_input' data-id='" + datetime + "' placeholder='USD/BYR/...' data-status='0' id='curr_name_" + datetime + "' type='text'/>" +
                "<input class='new_val_curr currency_input' placeholder='9100/4990...' id='curr_val_" + datetime + "' type='text'/> <a style='color:#fff;'>= 1$</a> " +
                "<a class='delete-item-curr' data-id='" + datetime + "'>Удалить</a>" +
                "</td>" +
                "</tr>");
    });











    $('#update_curr').click(function() {
        var arr_exists = new Array();
        var arr_new = new Array();
        $('.name_curr').each(function(k, v) {
            var id = $(this).attr('data-id');
            var obj = {
                id: id,
                val: $('#curr_val_' + id).val(),
                name: $(this).val(),
                status: $('#curr_name_' + id).attr('data-status')
            };
            arr_exists.push(obj);
        });
        $('.new_name_curr').each(function(k, v) {
            var id = $(this).attr('data-id');
            var obj = {
                id: $(this).attr('data-id'),
                val: $('#curr_val_' + id).val(),
                name: $(this).val(),
                status: $('#curr_name_' + id).attr('data-status')
            };
            if (obj.status !== 3) {
                arr_new.push(obj);
            }
        });
        console.log(arr_exists);
        var data = new FormData();
        arr_new = JSON.stringify(arr_new);
        arr_exists = JSON.stringify(arr_exists);
        data.append('arr_new', arr_new);
        data.append('arr_exists', arr_exists);
        var request = new getXHR();
        if (request) {
            var url = "/admin/update_currency";
            request.open("POST", url, true);


            request.onload = function(oEvent) {
                var text = request.response;
                if (text.length !== 0) {
                    $('#server_response').text();
                    $('#server_response').text(text);
                    $('.md-trigger').click();
                }
            }
            request.onerror = function(e) {
                var text = request.response;
                if (text.length !== 0) {
                    $('#server_response').text();
                    $('#server_response').text(text);
                    $('.md-trigger').click();
                }
            }
            request.send(data);
        }
    });
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