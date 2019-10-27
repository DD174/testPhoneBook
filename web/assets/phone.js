/**
 *
 */
$('.phone-add').on("click", function () {
    let $modal = $('#phone-modal');
    let $content = $('#phone-modal .modal-content');
    $modal.modal('show');
    $.ajax({
        url: '/?action=phone-edit',
        type: 'get',
        dataType: 'html'
    }).done(function (data, textStatus, jqXHR) {
        if (jqXHR.status === 200) {
            $content.html(data);
        } else {
            window.alert(data);
        }
    }).fail(function (xhr) {
        window.alert('Ошибка.' + xhr.responseText);
        window.console.log('error');
        window.console.log(xhr);
    });
});

$(document).on("submit", '#phone-form', function () {
    let $form = $(this);
    let $content = $('#phone-modal .modal-content');
    $.ajax({
        url: '/?action=phone-edit',
        type: 'post',
        dataType: 'html',
        data: $form.serialize()
    }).done(function (data, textStatus, jqXHR) {
        if (jqXHR.status === 200) {
            $content.html(data);
        } else {
            window.alert(data);
        }
    }).fail(function (xhr) {
        window.alert('Ошибка.' + xhr.responseText);
        window.console.log('error');
        window.console.log(xhr);
    });

    return false;
});