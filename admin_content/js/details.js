$(document).ready(function() {
    $('.tbody_details').delegate('.add_sub_detail', 'click', function() {
        var block_id = $(this).attr('data-id');
        var date_id = Math.round(new Date());
        console.log(1);
        var block_sub = $('#block_sub_id_' + block_id);
        block_sub.append('<div id="div_sub_'+date_id+'">' +
                '<input class="new_input_sub" group-id="' + block_id + '" id="input_sub_id_' + date_id + '" data-status="0" type="text" data-id="' + date_id + '" value=""/>' +
                '<a class="delete-sub" data-id="' + date_id + '">Удалить</a>' +
                '</div>')
    });
    $('#add_group_details').click(function() {
        var tbody_detail = $('.tbody_details');
        var select_cat = $('.categories_select:first').html();
        var date_id = Math.round(new Date());
        tbody_detail.append('<tr id="tr_group_'+date_id+'"><td id="select_cat_' + date_id + '">' +
                select_cat +
                '</td><td><input class="new_input_group" data-status="0" id="input_detail_id_' + date_id + '" data-id="' + date_id + '" type="text" value=""/><p>' +
                '<a class="delete-group" data-id="' + date_id + '">Удалить</a></p>' +
                '</td><td><button class="add_sub_detail" data-id="' + date_id + '">Добавить характеристику</button><div id="block_sub_id_' + date_id + '"></div>' +
                '</td></tr>');
    });
    $('.tbody_details').delegate('.delete-sub', 'click', function() {
        var block_id = $(this).attr('data-id');
        console.log(block_id);
        $('#div_sub_' + block_id).hide();
        $('#input_sub_id_' + block_id).attr('data-status', '3');
    });
    $('.tbody_details').delegate('.delete-group', 'click', function() {
        var t_id = $(this).attr('data-id');
        console.log(t_id);
        $('#input_detail_id_' + t_id).attr('data-status', '3');
        $('#tr_group_' + t_id).hide();
    });
    $('#apply_changes').click(function() {
        var group_exist = new Array();
        var group_new = new Array();
        var details_exist = new Array();
        var details_new = new Array();
        $('.new_input_group').each(function() {
            var id = $(this).attr('data-id');
            var name = $(this).val();
            var status = $(this).attr('data-status');
            var cid = $('#select_cat_' + id + ' select').val();
            var obj = {
                id_group: id,
                cid: cid,
                name: name,
                status: status
            };
            if (status !== 3) {
                group_new.push(obj);
            }
        });
        $('.input_group').each(function() {
            var id = $(this).attr('data-id');
            var name = $(this).val();
            var status = $(this).attr('data-status');
            var cid = $('#select_cat_' + id + ' select').val();
            var obj = {
                id_group: id,
                cid: cid,
                name: name,
                status: status
            };
            group_exist.push(obj);
        });




        $('.new_input_sub').each(function() {
            var id = $(this).attr('data-id');
            var gid = $(this).attr('group-id');
            var name = $(this).val();
            var status = $(this).attr('data-status');
            var cid = $('#select_cat_' + id + ' select').val();
            var obj = {
                gid: gid,
                id: id,
                name: name,
                status: status
            };
            if (status !== 3) {
                details_new.push(obj);
            }
        });
        $('.input_sub').each(function() {
            var id = $(this).attr('data-id');
            var gid = $(this).attr('group-id');
            var name = $(this).val();
            var status = $(this).attr('data-status');
            var cid = $('#select_cat_' + id + ' select').val();
            var obj = {
                gid: gid,
                id: id,
                name: name,
                status: status
            };
            details_exist.push(obj);
        });


        var data = new FormData();
        data.append('group_exist', JSON.stringify(group_exist));
        data.append('group_new', JSON.stringify(group_new));
        data.append('details_new', JSON.stringify(details_new));
        data.append('details_exist', JSON.stringify(details_exist));
        var request = getXHR();
        if (request) {
            var url = "/admin/details_edit";
            request.open("POST", url, true);

            request.onload = function(e) {
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

