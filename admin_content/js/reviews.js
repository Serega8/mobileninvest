$(document).ready(function() {
     $('#val_val').text($('#range_val').val());
    function check_rows() {
        var all = $('.one_review input,.one_review textarea');
        var of = true;
        all.each(function(k,v) {
            if ($(this).val() =='') {
                of = false;
            }
        })
        return of;
    }
    $('#range_val').change(function() {
       $('#val_val').text($(this).val());
    });
    $('#change_rev').click(function() {
        if (check_rows()) {
            var form = document.getElementById('form_rev');
            var data = new FormData(form);
            console.log(form);
            var request = new XMLHttpRequest();
            if (request) {
                var url = "/admin/rev_edit";
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
        }
        else {
            alert('Все полня должны быть заполнены!');
        }
    });
    $('#add_rev').click(function() {
        if (check_rows()) {
            var form = document.getElementById('form_rev');
            var data = new FormData(form);
            console.log(form);
            var request = new XMLHttpRequest();
            if (request) {
                var url = "/admin/rev_add";
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
        }
        else {
            alert('Все полня должны быть зполнены!');
        }
    });
});