$(document).ready(function () {

    // On change topic
    $('body').on('change', '#contact_sujet' ,function (e) {

        var url = $(this).attr('data-url');
        var value = $(this).val();
        var text = $(this).find('option:selected').text();

        var data = {
            'value': value,
            'text': text,
            'url' : url
        };

        // Ajax Request
        var updateForm = require('./updateForm');
        updateForm(data);

    });
});

