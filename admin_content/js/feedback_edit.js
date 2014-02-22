$(document).ready(function() {
    var uid = null;
    var nw = false;
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
    $('#feedback').delegate('.change_tag', 'click', function() {
        uid = $(this).attr('data-id');
        var area = $('#server_response');
        var change = $('#construct');
        var plch_col = $('#placeholder_col');
        var name_col = $('#name_col');
        var curr_name = $('#tag_id_' + uid + ' p:first').text().trim();
        var curr_placeholder = $('#tag_' + uid).attr('placeholder');
        plch_col.val(curr_placeholder);
        name_col.val(curr_name);
        area.html(change);
        change.css('display', 'block');
        $('.md-close').text('Применить');
        $('.md-trigger').click();
    });
    $('#feedback').delegate('.delete_tag', 'click', function() {
        uid = $(this).attr('data-id');
        var curr_status = $('#tag_' + uid).attr('data-status');
        switch (curr_status) {
            case '0':
                $('#tag_' + uid).attr('data-status', '3');
                $('#tag_' + uid).attr('disabled', 'disabled');
                $('#tag_id_' + uid).css('opacity', '0.3');
                $(this).text('Восстановить');
                break;
            case '3':
                $('#tag_' + uid).attr('data-status', '0');
                $('#tag_id_' + uid).css('opacity', '0.3');
                $('#tag_' + uid).removeAttr('disabled');
                $('#tag_id_' + uid).css('opacity', '1');
                $(this).text('Удалить');
                break;
            default:
                break;
        }

    });
    $('#add_col').click(function() {
        nw = true;
        var area = $('#server_response');
        var plch_col = $('#placeholder_col').val('');
        var name_col = $('#name_col').val('');
        var constr = $('#construct');
        constr.css('display', 'block');
        $('.md-close').text('Применить');
        area.html(constr);
        $('.md-trigger').click();
    });
    $('.md-close').click(function() {
        if ($(this).text().trim() === 'Применить') {
            var plch_col = $('#placeholder_col').val();
            var name_col = $('#name_col').val();
            var type_select = $('#select_type').val();
            var sel_type = $('#sel_type').val();
            var sel_type2 = $('#sel_type_2').val();

            if (!nw) {
                switch (type_select) {
                    case 'input':
                        $('#tag_id_' + uid).attr('type-tag', type_select);
                        var new_html = '<p class="p_feedback_name">' + name_col + '</p>' +
                                '<input class="input_feedback_name" type="' + sel_type2  + '" data-status="0" data-id="' + uid + '" id="tag_' + uid + '" placeholder="' + plch_col + '"/>' +
                                '<a class="change_tag" data-id="' + uid + '">Изменить</a> /' +
                                '<a class="delete_tag" data-id="' + uid + '">Удалить</a>';
                        break;
                    case 'textarea':
                        $('#tag_id_' + uid).attr('type-tag', type_select);
                        var new_html = '<p class="p_feedback_name">' + name_col + '</p>' +
                                '<textarea class="input_feedback_name" data-status="0" data-id="' + uid + '" id="tag_' + uid + '" placeholder="' + plch_col + '"></textarea>' +
                                '<a class="change_tag" data-id="' + uid + '">Изменить</a> /' +
                                '<a class="delete_tag" data-id="' + uid + '">Удалить</a>';
                        break;
                    case 'select':
                        break;
                    default:
                        break;
                }
                $('#tag_id_' + uid).html(new_html);
            }
            else {
                var dt = Math.round(new Date());
                switch (type_select) {
                    case 'input':

                        var new_html = '<div id="tag_id_' + dt + '" class="new_feedback" type-tag="' + type_select + '"><p class="p_feedback_name">' + name_col + '</p>' +
                                '<input type="' + sel_type2  + '" data-status="0" data-id="' + dt + '" id="tag_' + dt + '" placeholder="' + plch_col + '"/>' +
                                '<a class="change_tag" data-id="' + dt + '">Изменить</a> /' +
                                '<a class="delete_tag" data-id="' + dt + '">Удалить</a></div>';
                        break;
                    case 'textarea':
                        var new_html = '<div id="tag_id_' + dt + '" class="new_feedback" type-tag="' + type_select + '"><p class="p_feedback_name">' + name_col + '</p>' +
                                '<textarea class="input_feedback_name" data-status="0" data-id="' + dt + '" id="tag_' + dt + '" placeholder="' + plch_col + '"></textarea>' +
                                '<a class="change_tag" data-id="' + dt + '">Изменить</a> /' +
                                '<a class="delete_tag" data-id="' + dt + '">Удалить</a></div>';
                        break;
                    case 'select':
                        break;
                    default:
                        break;
                }
                $('#feedback').append(new_html);
                nw = false;
            }
        }
        else {

        }
        $(this).text('Закрыть');
    });
    $('#add_feedback').click(function() {
        var exist_tags = new Array();
        var new_tags = new Array();
        $('.new_feedback').each(function(key, val) {
            var id_arr = $(this).attr('id').split('_');
            var id = id_arr[id_arr.length - 1];
            var obj = {
                id: null,
                status: $('#tag_' + id).attr('data-status'),
                type_tag: $(this).attr('type-tag'),
                sel_type: $('#tag_' + id).attr('type') || null,
                placeholder: $('#tag_' + id).attr('placeholder'),
                name: $('#tag_id_' + id + ' p:first').text().trim()
            };
            if ($('#tag_' + id).attr('data-status') === '0') {
                new_tags.push(obj);
            }
            console.log(obj.status);
        });
        $('.tags_feedback').each(function(key, val) {
            var id_arr = $(this).attr('id').split('_');
            var id = id_arr[id_arr.length - 1];
            var obj = {
                id: id,
                status: $('#tag_' + id).attr('data-status'),
                type_tag: $(this).attr('type-tag'),
                sel_type: $('#tag_' + id).attr('type') || null,
                placeholder: $('#tag_' + id).attr('placeholder'),
                name: $('#tag_id_' + id + ' p:first').text().trim()
            };
            console.log(obj);
            exist_tags.push(obj);
        });
        var data = new FormData();
        exist_tags = JSON.stringify(exist_tags);
        new_tags = JSON.stringify(new_tags);
        data.append('exist_tags', exist_tags);
        data.append('new_tags', new_tags);
        var request = new getXHR();
        if (request) {
            var url = "/admin/feedback_edit";
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


});