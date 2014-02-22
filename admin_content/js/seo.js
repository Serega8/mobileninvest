$(document).ready(function() {
    $('#update_seo').click(function() {
        var seo_arr = new Array();
        $('.seo_textarea').each(function() {
            seo_arr.push($(this).val());
        });
        var id = $('#ident').val() || null;
        var data = new FormData();
        data.append('k', seo_arr[0]);
        data.append('s', seo_arr[1]);
        data.append('t', seo_arr[2]);
        data.append('d', seo_arr[3]);
        data.append('id', id);
        data.append('d_type', $(this).attr('d-type'));
        var request = new XMLHttpRequest();
        if (request) {
            var url = '/admin/seo_update';
            request.open("POST", url, true);

            request.onload = function(e) {
                var text = request.response;
                if (text.length !== 0) {
                    $('#server_response').text(text);
                    $('.md-trigger').click();
                }
            }
            request.onerror = function(e) {
                var text = request.response;
                if (text.length !== 0) {
                    $('#server_response').text(text);
                    $('.md-trigger').click();
                }
            }
            request.send(data);
        }
    });
    $('#show_seo_data').click(function() {
        $('#seo_box').toggle('easing');
    });
});