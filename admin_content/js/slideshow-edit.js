$(document).ready(function() {
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

    $('#slide_apply_btn').click(function() {
        var arr_images = new Array();
        $('.img_data').each(function(key, value) {
            var id = $(this).attr('gid');

            var obj = {
                id: id,
                status: $(this).attr('data-status'),
                img_alt: $(this).val(),
                img_title: $('#title_img_id_' + id).val()
            }
            arr_images.push(obj);
        });
        var images_data = JSON.stringify(arr_images);









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
                if (count == (files.length - 1)) {
                    data.append('images_data', images_data);
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
                    else {
                        var text = 'Картинки добавлены';
                        $('#server_response').text();
                        $('#server_response').text(text);
                        $('.md-trigger').click();
                    }
                }, false)
                var url = '/admin/slideshow_edit';
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
                    if (count == 1) {
                        var text = request.response;
                        if (text.length !== 0) {
                            $('#server_response').text();
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
            data.append('images_data', images_data);
            var request = new getXHR();
            if (request) {
                var url = "/admin/slideshow_edit";
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
        }

    });
});