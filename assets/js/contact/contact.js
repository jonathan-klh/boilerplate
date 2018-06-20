$(document).ready(function () {
    $('#subcribe_request_sujet').on('change', function (e) {
        console.log($('#subcribe_request_sujet'));
        console.log('dedans');

        var value = $(this).val();
        var text = $(this).find('option:selected').text();
        var data = {
            'value': value,
            'text': text
        };

        $.ajax({
            url: url,
            data: { text: data.text, value: data.value },
            method: 'GET', success: function (s) {

            }
        });
        console.log(data)
    });
});

