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
            button.toggleClass('btn-primary');
            button.find(".likes-count").html(data.likes_count);
            if (dislike.hasClass('btn-primary')) {
                dislike.removeClass('btn-primary');
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
            button.toggleClass('btn-primary');
            button.find(".dislikes-count").html(data.dislikes_count);
            if (like.hasClass('btn-primary')) {
                like.removeClass('btn-primary');
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

$('.btn-comments').each(function () {
    $(this).on("click", function () {
        var button = $(this);
        var id = button.data('id');
        var type = button.data('type');
        var modal = $('#commentsModal');
        var modalbody = $('#commentsModalBody');
        $.get('/api/comments', { commentable_type: type, commentable_id: id, _token: token })
            .done(function (data) {
                modalbody.html(data);
                $("#commentsPostButton").data('id', id);
                $("#commentsPostButton").data('type', type);
                $("#commentsPostButton").data('button', button);
                modal.modal('show');
            })
            .fail(function (data) {
                console.log(data.responseText);
            })
            .always(function (data ) {

            });
    });
});

$('#commentsPostButton').on("click", function (e) {
    e.preventDefault();
    var button = $(this);
    var id = button.data('id');
    var type = button.data('type');
    var modal = $('#commentsModal');
    var modalbody = $('#commentsModalBody');
    var body = $('#commentsBody').val();
    $.post('/api/comment', { commentable_type: type, commentable_id: id, body: body, _token: token })
        .done(function (data) {
            modalbody.html(data);
            $('#commentsBody').val("");
            count = modalbody.find('.comments').data('count');
            button.data('button').find('.comments-count').html(count);
        })
        .fail(function (data) {
            modalbody.html(data.responseText);
        })
        .always(function (data) {
            modalbody.html(data.responseText);
        });
});