$(document).ready(function() {

    $('#edit_poll').delegate('.delete-item-poll', 'click', function() {
        uid = $(this).attr('data-id');
        var curr_status = $('#item_poll_id_' + uid).attr('data-status');
        switch (curr_status) {
            case '0':
                $('#item_poll_id_' + uid).attr('data-status', '3');
                $('#item_poll_id_' + uid).attr('disabled', 'disabled');
                $('#tr_item_id_' + uid).css('opacity', '0.3');
                $(this).text('Восстановить');
                break;
            case '3':
                $('#item_poll_id_' + uid).attr('data-status', '0');
                $('#item_poll_id_' + uid).css('opacity', '0.3');
                $('#item_poll_id_' + uid).removeAttr('disabled');
                $('#item_poll_id_' + uid).css('opacity', '1');
                $('#tr_item_id_' + uid).css('opacity', '1');
                $(this).text('Удалить');
                break;
            default:
                break;
        }

    });
    $('#add_item_poll').click(function() {
        var datetime = Math.round(new Date());
        $('.poll_tr_name').append("<tr id='tr_item_id_" + datetime + "'>" +
                "<td>" +
                "<input class='new_item_poll' data-status='0' id='item_poll_id_" + datetime + "' type='text'/>" +
                "<a class='delete-item-poll' data-id='" + datetime + "'>Удалить</a>" +
                "</td>" +
                "</tr>");
    });
    $('#update_poll').click(function() {
        var data_type = $(this).attr('data-type');
        var question = $('#question').val();
        var arr_exists = new Array();
        var arr_new = new Array();
        var id = $('#poll_id').val();
        switch (data_type) {
            case 'edit':
                $('.exist_item_poll').each(function(k, v) {
                    var obj = {
                        id: $(this).attr('data-id'),
                        val: $(this).val(),
                        status: $(this).attr('data-status')
                    };
                    arr_exists.push(obj);
                });
                $('.new_item_poll').each(function(k, v) {
                    var obj = {
                        id: 0,
                        val: $(this).val(),
                        status: $(this).attr('data-status')
                    };
                    if (obj.status !== 3) {
                        arr_new.push(obj);
                    }
                });
                break;
            case 'add':
                $('.new_item_poll').each(function(k, v) {
                    var obj = {
                        id: 0,
                        val: $(this).val(),
                        status: $(this).attr('data-status')
                    };
                    if (obj.status !== 3) {
                        arr_new.push(obj);
                    }
                });
                break;
            default:
                break;
        }

        console.log(arr_new);
        console.log(arr_exists);
        var data = new FormData();
        arr_new = JSON.stringify(arr_new);
        arr_exists = JSON.stringify(arr_exists);
        data.append('arr_new', arr_new);
        data.append('q', question);
        data.append('type', data_type);
        data.append('poll_id', id);
        data.append('arr_exists', arr_exists);
        var request = new getXHR();
        if (request) {
            var url = "/admin/update_poll";
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