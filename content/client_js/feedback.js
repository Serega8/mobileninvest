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
    $('#send_message').click(function() {
        var textbox = new Array();
        var check = false;
        $('.feedback_rows').each(function() {
            var ident = $(this).attr('data-id');
            var value = $(this).val().trim();
            if (value.length === 0) {
                check = false;
                return false;
            }
            else {
                var text = {
                    id: ident,
                    text: value
                };
                textbox.push(text);
                check = true;
            }
        });
        if (check) {
            var data = new FormData();
            textbox = JSON.stringify(textbox);
            data.append('textbox', textbox);
            var request = new getXHR();
            if (request) {
                var url = "/send_message";
                request.open("POST", url, true);
                request.onload = function(oEvent) {
                    var text = request.response;
                    $('#server_response').html(text);
                    $('.md-trigger').click();
                }
                request.onerror = function(e) {
                    var text = request.response;
                    $('#server_response').html(text);
                    $('.md-trigger').click();
                }
                request.send(data);
            } else {
                alert('Обновите ваш браузер!');
            }
        }
    });
});