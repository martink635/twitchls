$(document).ready(function() {
    $('#hide-chat').click(function() {
        $(this).html($(this).html() == '<span class="glyphicon glyphicon-indent-left"></span>' ? '<span class="glyphicon glyphicon-indent-right"></span>' : '<span class="glyphicon glyphicon-indent-left"></span>');
        $(this).toggleClass('btn-on-stream');
        $('#chat').toggleClass('hidden col-md-3');
        $('#stream').toggleClass('col-md-9 col-md-12');
    });
});