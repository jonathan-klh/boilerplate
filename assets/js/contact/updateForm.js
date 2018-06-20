module.exports = function(data) {
    $.ajax({
        url: data.url,
        data: { text: data.text, value: data.value },
        method: 'GET', success: function (s) {
            $('#formByTopic').html(s.view);

        }, error: function (er) {
            console.log(er)
        }
    });
};