$(document).ready(function() {
//    $('table').delegate('.add_sub_detail', 'click', function() {
//        var id = $(this).attr('data-id');
//        var tr_block = $('#group_id_' + id);
//
//        var id_date = Math.round(new Date());
//
//        tr_block.append('<div class="chars-div"><input class="new-chars" placeholder="Характеристика" data-group-id="' + id + '" data-status="0" id="' + id_date + '" type="text" value=""/> ' +
//                '<span id="span_' + id_date + '">: </span>' +
//                '<input placeholder="Значение" type="text" id="val_new_' + id_date + '" value=""/>' +
//                ' <a class="delete-char" data-id="' + id_date + '">Удалить</a><br id="br_' + id_date + '"/></div>');
//
//
//
//    });
//    $('table').delegate('.delete-char', 'click', function() {
//        var id = $(this).attr('data-id');
//        $(this).hide();
//        $('#' + id).attr('data-status', '3');
//        $('#span_' + id).hide();
//        $('#val_new_' + id).hide();
//        $('#val_' + id).hide();
//        $('#br_' + id).hide();
//        $('#' + id).hide();
//    });
//
//    $('table').delegate('.delete-group', 'click', function() {
//        var id = $(this).attr('gid');
//        console.log(id);
//        $('#tr_id_' + id).hide();
//        $('#group_id_name_' + id).attr('data-status', '3');
//    });



    $('#product_cost').keyup(function() {
        $(this).val(accounting.formatNumber($(this).val()));
        convert();
    });
    $('#product_currency').change(function() {

        convert();
    });

    function convert() {
        var value = accounting.unformat($('#product_cost').val());
        var result = new Array();
        var cur_val_id = -1;
        var arr_key = -1;
        var currency_id = $('#product_currency').val();
        for (var i = 0; i < curr_arr.length; i++) {
            if (curr_arr[i].id == currency_id) {
                cur_val_id = curr_arr[i].id;
                arr_key = i;
            }
        }
        for (var i = 0; i < curr_arr.length; i++) {
            var obj = {
                id: curr_arr[i].id,
                name: curr_arr[i].name,
                val: Math.round(curr_arr[i].val / curr_arr[arr_key].val * value)
            }
            result.push(obj);
        }
        for (var j = 0; j < result.length; j++) {
            $('#name_curr_id_' + result[j].id).text(result[j].name);
            $('#val_curr_id_' + result[j].id).text(accounting.formatNumber(result[j].val));
        }
    }

    $('.product_images').click(function() {
        var id = $(this).attr('gid');
        var status = $('#img_id_delete_' + id).attr('data-status');
        switch (status) {
            case '0':
                $('#img_id_delete_' + id).attr('data-status', '3');
                $(this).addClass('deleted_img');
                $(this).removeClass('block-images-product-img');
                $('#title_img_id_' + id).attr('disabled', 'disabled');
                $('#img_id_delete_' + id).attr('disabled', 'disabled');
                break;
            case '3':
                $('#img_id_delete_' + id).attr('data-status', '0');
                $(this).removeClass('deleted_img');
                $(this).addClass('block-images-product-img');
                $('#title_img_id_' + id).removeAttr('disabled');
                $('#img_id_delete_' + id).removeAttr('disabled');
                break;
            default:
                break;
        }

    });
//
//    $('.new_group_button').click(function() {
//        var tbody_n = $('.tbody_n');
//        var id_date = Math.round(new Date());
//        tbody_n.append('<tr id="tr_id_' + id_date + '"><td>' +
//                '<input data-status="0" type="text" id="group_id_name_' + id_date + '" gid="' + id_date + '" class="details_name_new" value="" placeholder="Название группы"/>' +
//                '<br/><a class="delete-group" gid="' + id_date + '">Удалить</a></td>' +
//                '<td id="group_id_' + id_date + '"><button data-id="' + id_date + '" class="add_sub_detail" >Добавить характеристику</button><br/></td></tr>')
//    });


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



    $('.btn_apply').click(function() {
        var str = window.location + '';
        var cat_name = str.split('/');
        var cat = cat_name[5];
        var sub = cat_name[6];
        if (sub == 'new_product') {
            var dop = '<br/><br/><a class="dop_a" href="/admin/catalog/' + cat + '">Перейти к списку товаров</a><br/>' +
                    '<a class="dop_a" href="/admin/catalog/' + cat + '/' + sub + '">Добавить товар</a>';

        }
        else {
            var dop = '<br/><br/><a class="dop_a" href="/admin/catalog/' + cat + '/' + sub + '">Перейти к списку товаров</a><br/>' +
                    '<a class="dop_a" href="/admin/catalog/' + cat + '/' + sub + '/new_product">Добавить товар</a>';
        }
        console.log(dop);
        var product_name = $('#product_name').val();
        var product_id = $('#product_id').val();
        var product_brand = $('#product_brand').val();
        var product_cost = accounting.unformat($('#product_cost').val());
        var url = $('#url_translit').val();
        var product_currency = $('#product_currency').val();
        var k = $('#k').val();
        var d = $('#d').val();
        var s = $('#s').val();
        var t = $('#t').val();
        if (product_name.length == 0) {
            var text = 'Имя обязательно';
            $('#server_response').text();
            $('#server_response').text(text);
            $('.md-trigger').click();
            return false;
        }
        array_values = new Array();
//        var data = {};
//        var arr_exist = new Array();
//        var arr_new = new Array();
        var arr_images = new Array();
//        var group_name_exist = new Array();
//        var group_name_new = new Array();
//        $('.ex-chars').each(function(key, value) {
//            var this_id = $(this).attr('id');
//            var obj = {
//                group_id: $(this).attr('data-group-id'),
//                key: $(this).val(),
//                status: $(this).attr('data-status'),
//                value: $('#val_' + this_id).val(),
//                id: this_id
//            }
//            arr_exist.push(obj);
//
//        });
        $('.img_data').each(function(key, value) {
            var id = $(this).attr('gid');

            var obj = {
                id: id,
                status: $(this).attr('data-status'),
                img_alt: $(this).val(),
                img_title: $('#title_img_id_' + id).val()
            };
            arr_images.push(obj);
        });
        $('.values').each(function(key, value) {
            var sub_id = $(this).attr('detail-id');
            var obj = {
                sid: sub_id,
                val_id: $(this).attr('val-id') || null,
                val: $(this).val()
            };
            array_values.push(obj);
        });



        var images_data = JSON.stringify(arr_images);
        var values = JSON.stringify(array_values);

        var databox = document.getElementById('databox');
        var files = document.getElementById('files').files;
        if (files.length) {
            var list = '';
            for (var f = 0; f < files.length; f++) {
                var file = files[f];
                list += '<blockqoute> Файл: ' + file.name;
                list += '<span><progress value="0" max="100">0%</progress></span>';
                list += '</blockqoute>';
            }
            databox.innerHTML = list;
            var count = 0;

            var upload = function() {
                var file = files[count];
                var data = new FormData();
                data.append('file', file);
                data.append('product_id', product_id);
                if (count == 0) {
                    data.append('main', 'main');
                    data.append('values', values);
                    data.append('url', url);
                    data.append('k', k);
                    data.append('d', d);
                    data.append('s', s);
                    data.append('t', t);
                    data.append('images_data', images_data);
                    data.append('product_brand', product_brand);
                    data.append('product_cost', product_cost);
                    data.append('product_currency', product_currency);
                    data.append('product_name', product_name);
                }

                var request = new getXHR();
                var xmlupload = request.upload;
                xmlupload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        var child = count + 1;
                        var per = parseInt(e.loaded / e.total * 100);
                        var progressbar = databox.querySelector(
                                "blockqoute:nth-child(" + child + ")>span>progress");
                        progressbar.value = per;
                        progressbar.innerHTML = per + '%';
                    }
                }, false)

                xmlupload.addEventListener('load', function() {
                    var child = count + 1;
                    var elem = databox.querySelector("blockqoute:nth-child(" + child + ")>span");
                    elem.innerHTML = ' загружен <br/>';
                    count++;
                    if (count < files.length) {
                        upload();
                    }
                }, false)
                var url = '/admin/show_product_data';
                request.open("POST", url, true);
                request.onload = function(e) {
                    var text = request.response;
                    if (text.length !== 0) {
                        $('#server_response').html(text+dop);
                        $('.md-trigger').click();
                    }

                }
                request.onerror = function(e) {
                    if (count == 1) {
                        var text = request.response;
                        if (text.length !== 0) {
                            $('#server_response').text(text);
                            $('.md-trigger').click();
                        }
                    }
                }
                request.send(data);
            }
            upload();
        } else {
            var data = new FormData();
            data.append('url', url);
            data.append('main', 'main');
            data.append('images_data', images_data);
            data.append('product_cost', product_cost);
            data.append('product_currency', product_currency);
            data.append('product_id', product_id);
            data.append('values', values);
            data.append('product_brand', product_brand);
            data.append('product_name', product_name);
            data.append('k', k);
            data.append('d', d);
            data.append('s', s);
            data.append('t', t);

            var request = new getXHR();
            if (request) {
                var url = "/admin/show_product_data";
                request.open("POST", url, true);


                request.onload = function(oEvent) {
                    var text = request.response;
                    if (text.length !== 0) {
                        console.log(text);
                        $('#server_response').html(text+dop);
                        $('.md-trigger').click();
                    }
                }
                request.onerror = function(e) {
                    var text = request.response;
                    if (text.length !== 0) {
                        console.log(text);
                        $('#server_response').text(text);
                        $('.md-trigger').click();
                    }
                }
                request.send(data);
            }
        }
    });










    $('#btn_add_product').click(function() {
        var str = window.location + '';
        var cat_name = str.split('/');
        var cat = cat_name[5];
        var sub = cat_name[6];
        if (sub == 'new_product') {
            var dop = '<br/><br/><a class="dop_a" href="/admin/catalog/' + cat + '">Перейти к списку товаров</a><br/>' +
                    '<a class="dop_a" href="/admin/catalog/' + cat + '/' + sub + '">Добавить еще товар</a>';

        }
        else {
            var dop = '<br/><br/><a class="dop_a" href="/admin/catalog/' + cat + '/' + sub + '">Перейти к списку товаров</a><br/>' +
                    '<a class="dop_a" href="/admin/catalog/' + cat + '/' + sub + '/new_product">Добавить еще товар</a>';
        }


        var arr_new = new Array();
        var group_name_new = new Array();
        var level2 = $('#level2').val();
        var level3 = $('#level3').val();
        var product_name = $('#product_name').val();
        if (product_name.length == 0) {
            var text = 'Имя обязательно';
            $('#server_response').text(text);
            $('.md-trigger').click();
            return false;
        }
        var url = $('#url_translit').val();
        var product_cost = $('#product_cost').val();
        var product_brand = $('#product_brand').val();
        var product_currency = accounting.unformat($('#product_currency').val());
        var k = $('#k').val();
        var d = $('#d').val();
        var s = $('#s').val();
        var t = $('#t').val();
        var array_values = new Array();


        var databox = document.getElementById('databox');
        var files = document.getElementById('files').files;

        $('.values').each(function(key, value) {
            var sub_id = $(this).attr('detail-id');
            var obj = {
                sid: sub_id,
                val_id: $(this).attr('val-id') || null,
                val: $(this).val()
            };
            array_values.push(obj);
        });
        var values = JSON.stringify(array_values);




        if (files.length) {
            var list = '';
            for (var f = 0; f < files.length; f++) {
                var file = files[f];
                list += '<blockqoute> Файл: ' + file.name;
                list += '<span><progress value="0" max="100">0%</progress></span>';
                list += '</blockqoute>';
            }
            databox.innerHTML = list;
            var count = 0;

            var upload = function() {
                var file = files[count];
                var data = new FormData();
                data.append('file', file);
                if (count == 0) {
                    data.append('main', 'main');
                    data.append('values', values);
                    data.append('k', k);
                    data.append('d', d);
                    data.append('s', s);
                    data.append('t', t);

                    data.append('url', url);
                    data.append('product_cost', product_cost);
                    data.append('product_currency', product_currency);
                    data.append('product_name', product_name);
                    data.append('product_brand', product_brand);
                    data.append('level2', level2);
                    data.append('level3', level3);
                }

                var request = new getXHR();
                var xmlupload = request.upload;
                xmlupload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        var child = count + 1;
                        var per = parseInt(e.loaded / e.total * 100);
                        var progressbar = databox.querySelector(
                                "blockqoute:nth-child(" + child + ")>span>progress");
                        progressbar.value = per;
                        progressbar.innerHTML = per + '%';
                    }
                }, false)

                xmlupload.addEventListener('load', function() {
                    var child = count + 1;
                    var elem = databox.querySelector("blockqoute:nth-child(" + child + ")>span");
                    elem.innerHTML = ' загружен <br/>';
                    count++;
                    if (count < files.length) {
                        upload();
                    }
                }, false)
                var url = '/admin/add_new_product';


                request.open("POST", url, true);
                request.onload = function(e) {
                    var text = request.response;
                    if (text.length !== 0) {
                        console.log(text);
                        $('#server_response').text();
                        $('#server_response').html(text + dop);
                        $('.md-trigger').click();
                    }
                }
                request.onerror = function(e) {
                    var text = request.response;
                    if (text.length !== 0) {
                        console.log(text);
                        $('#server_response').text();
                        $('#server_response').text(text);
                        $('.md-trigger').click();
                    }
                }
                request.send(data);
            }
            upload();
        } else {
            var data = new FormData();
            data.append('main', 'main');
            data.append('product_cost', product_cost);
            data.append('product_currency', product_currency);
            data.append('product_name', product_name);
            data.append('values', values);
            data.append('k', k);
            data.append('d', d);
            data.append('s', s);
            data.append('t', t);

            data.append('url', url);
            data.append('product_brand', product_brand);
            data.append('level2', level2);
            data.append('level3', level3);

            var request = new getXHR();
            if (request) {
                var url = "/admin/add_new_product";
                request.open("POST", url, true);


                request.onload = function(oEvent) {
                    var text = request.response;
                    $('#server_response').html(text + dop);
                    $('.md-trigger').click();
                }
                request.onerror = function(e) {
                    var text = request.response;
                    $('#server_response').text(text);
                    $('.md-trigger').click();
                }
                request.send(data);
            }
            else {
                alert('Не поддерживается браузер');
            }
        }




    });










});