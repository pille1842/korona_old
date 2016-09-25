// Alle Tooltips aktivieren

var token = $('#token').val();

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$("body").on("click", ".btn-like", function () {
    var button = $(this);
    var id = button.data('id');
    var type = button.data('type');
    var parent = button.parent();
    var dislike = parent.find(".btn-dislike");
    button.prop("disabled", true);
    $.post('/api/like', { likable_type: type, likable_id: id, _token: token })
        .done(function (data) {
            button.toggleClass('btn-success');
            button.find(".likes-count").html(data.likes_count);
            if (dislike.hasClass('btn-danger')) {
                dislike.removeClass('btn-danger');
                dislike.find(".dislikes-count").html(data.dislikes_count);
            }
        })
        .fail(function (data) {
            alert(data.message);
        })
        .always(function (data) {
            button.prop("disabled", false);
        });
});

$("body").on("click", ".btn-dislike", function () {
    var button = $(this);
    var id = button.data('id');
    var type = button.data('type');
    var parent = button.parent();
    var like = parent.find(".btn-like");
    button.prop("disabled", true);
    $.post('/api/dislike', { dislikable_type: type, dislikable_id: id, _token: token })
        .done(function (data) {
            button.toggleClass('btn-danger');
            button.find(".dislikes-count").html(data.dislikes_count);
            if (like.hasClass('btn-success')) {
                like.removeClass('btn-success');
                like.find(".likes-count").html(data.likes_count);
            }
        })
        .fail(function (data) {
            alert(data.message);
        })
        .always(function (data) {
            button.prop("disabled", false);
        });
});
