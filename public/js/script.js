$(document).ready(function() {
    $('#hide-chat').click(function() {
        $(this).html($(this).html() == '<span class="glyphicon glyphicon-indent-left"></span>' ? '<span class="glyphicon glyphicon-indent-right"></span>' : '<span class="glyphicon glyphicon-indent-left"></span>');
        $(this).toggleClass('btn-on-stream');
        $('#chat').toggleClass('hidden col-md-3');
        $('#stream').toggleClass('col-md-9 col-md-12');
    });

    if (! canPlayHLS()) {
        $('#no-hls-alert').toggleClass('hidden');

        $('#stream iframe').attr('src', function(index, attribute) {
            return attribute.replace('hls', 'embed');
        });
    }
});


var canPlayHLS = function() {
    var result = document.createElement('video').canPlayType('application/vnd.apple.mpegURL')

    if (result === "maybe") {
        return true;
    }

    return false;
}
