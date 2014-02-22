$(document).ready(function() {
    /*
     * Смена статусов категорий, подкатегорий, товаров
     */

    var ready_data;
    $('#input_open').click(function() {
        ('#input_file').click();
    });
    $('.cat_select').change(function() {
        console.log('changing');
        var curr_status = $(this).attr('data-status');
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var d = $(this).val();
        var msg = 'Сменить статус на "активный"?';
        if (curr_status == 0) {
            msg = 'Сменить статус на "нактивный"?';
        }
        if (d == 3) {
            msg = 'Удалить?';
        }
        if (confirm(msg)) {
            deactivate_category(id, curr_status, d, type);
        }
    });

    function deactivate_category(id, status, d, type) {
        if (d == 3) {
            status = 3;
        }
        else {
            if (status == 1) {
                status = 0;
            }
            else if (status == 0) {
                status = 1;
            }
        }
        var data = new FormData();
        data.append('id', id);
        data.append('type', type);
        data.append('status', status);
        var request = new getXHR();
        if (request) {
            var url = "/admin/set_category_status";
            request.open("POST", url, true);


            request.onload = function(oEvent) {
                alert(request.response);
                reload_page();
            }
            request.onerror = function(e) {
                alert(request.response);
                reload_page();
            }
            request.send(data);
        }
        else {
            alert('Не поддерживается браузер');
        }
    }
    /*
     * Редактирование категорий, подкатегорий
     */

    $('#apply_category').click(function() {
        var type_apply = $(this).attr('data-type');
        upload(type_apply);
        function upload(type_apply) {
            var dop = null;
            switch (type_apply) {
                case 'new_category':
                    var dop = '<br/><br/><a class="dop_a" href="/admin/catalog/new_category">Добавить новую категорию</a>' +
                            '<br/><a class="dop_a" href="/admin/catalog/">Перейти к списку категорий</a>';
                    break;
                case 'category_edit':
                    dop = '<br/><br/><a class="dop_a" href="/admin/catalog/new_category">Добавить новую категорию</a>' +
                            '<br/><a class="dop_a" href="/admin/catalog/">Перейти к списку категорий</a>';
                    break;
                case 'new_sub_category':
                    var str = window.location + '/';
                    var cat_name = str.split('/');
                    cat_name = cat_name[5];
                    dop = '<br/><br/><a class="dop_a" href="/admin/catalog/' + cat_name + '/new_sub_category">Добавить новую подкатегорию</a>' +
                            '<br/><a class="dop_a" href="/admin/catalog/' + cat_name + '">Перейти к списку подкатегорий</a>';
                    break;
                case 'sub_category_edit':
                    var str = window.location + '/';
                    var cat_name = str.split('/');
                    cat_name = cat_name[5];
                    dop = '<br/><br/><a class="dop_a" href="/admin/catalog/' + cat_name + '/new_sub_category">Добавить новую подкатегорию</a>' +
                            '<br/><a class="dop_a" href="/admin/catalog/' + cat_name + '">Перейти к списку подкатегорий</a>';
                    break;
                default:
                    dop = '';
                    break;
            }
            var category_name = $('#category_name').val();
            if (category_name.length == 0) {
                var text = 'Имя обязательно';
                $('#server_response').text(text);
                $('.md-trigger').click();
                return false;
            }
            var ident = $('#ident').val();
            var url = $('#url_translit').val();
            var img_alt = $('#img_alt').val();
            var img_title = $('#img_title').val();
            var id = $('#cat_id').val();

            var k = $('#k').val();
            var d = $('#d').val();
            var s = $('#s').val();
            var t = $('#t').val();

            var descr = $('#descr').val();
            var file = document.getElementById('category_image').files[0];
            var translit = $('#level').val();
            var data = new FormData();

            data.append('k', k);
            data.append('d', d);
            data.append('s', s);
            data.append('t', t);


            data.append('url', url);
            data.append('file', file);
            data.append('id', ident);
            data.append('translit', translit);
            data.append('descr', descr);
            data.append('parent_category', $('#level').val());
            data.append('type_apply', type_apply);
            data.append('category_name', category_name);
            data.append('img_alt', img_alt);
            data.append('img_title', img_title);
            var url = '/admin/category_settings';
            var request = new XMLHttpRequest();
            var xmlupload = request.upload;
            xmlupload.addEventListener('loadstart', start, false);
            xmlupload.addEventListener('progress', status, false);
            xmlupload.addEventListener('load', show, false);
            request.open("POST", url, true);

            request.onload = function(oEvent) {
                var text = request.response;
                $('#server_response').html(text + dop);
                $('.md-trigger').click();
                console.log(request.response);
            }
            request.onerror = function(e) {
                var text = request.response;
                $('#server_response').text()
                $('#server_response').text(text);
                $('.md-trigger').click();
                console.log(request.response);
            }
            request.send(data);
        }
        function start() {
            databox.innerHTML = '<progress value ="0" max="100">0%</progress>';
        }
        function status(e) {
            if (e.lengthComputable) {
                var databox = $('#databox');
                var per = parseInt(e.loaded / e.total * 100);
                var progressbar = databox.querySelector('progress');
                progressbar.value = per;
                progressbar.innerHTML = per + '%';
            }
        }
        function show(e) {
            databox.innerHTML = '<span style="color:#fff">Информация отправлена</span>';
        }
    });





















    $('#show_tree').click(function() {
        $('#tree_div').toggle();
    });

    function reload_page() {
        window.location.href = window.location.href;
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