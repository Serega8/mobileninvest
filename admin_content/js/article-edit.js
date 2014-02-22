$(document).ready(function() {
    bkLib.onDomLoaded(function() {
        var editor = new nicEditor();
        editor.panelInstance('article_descr');
    });
    $('#btn_article_apply').click(function() {
        upload();
        function upload() {
            var name = $('#article_name').val();
            if (name.length == 0) {
                var text = 'Название обязательно';
                $('#server_response').text();
                $('#server_response').text(text);
                $('.md-trigger').click();
                return false;
            }
            var data_type = $('#article_id').attr('data-type');
            var img_alt = $('#img_alt').val();
            var img_title = $('#img_title').val();
            var id = $('#article_id').val();
            var k = $('#k').val();
            var d = $('#d').val();
            var s = $('#s').val();
            var t = $('#t').val();
            if (!img_alt) {
                img_alt = '';
            }
            if (!img_title) {
                img_title = '';
            }
            var file = document.getElementById('files').files[0];
            var descr =  nicEditors.findEditor('article_descr').getContent();
            var data = new FormData();
            data.append('file', file);
            data.append('id', id);
            data.append('k', k);
            data.append('d', d);
            data.append('s', s);
            data.append('t', t);
            data.append('descr', descr);
            data.append('name', name);
            data.append('type', data_type);
            data.append('img_alt', img_alt);
            data.append('img_title', img_title);
            var url = '/admin/article_edit';
            var request = new XMLHttpRequest();
            var xmlupload = request.upload;
            xmlupload.addEventListener('loadstart', start, false);
            xmlupload.addEventListener('progress', status, false);
            xmlupload.addEventListener('load', show, false);
            request.open("POST", url, true);
            request.onload = function(oEvent) {
                var text = request.response;
                $('#server_response').text();
                $('#server_response').text(text);
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
        }}
    );
});