/**
 *
 */
function showPhoneForm(phoneId = '') {
    let $modal = $('#phone-modal');
    let $content = $('#phone-modal .modal-content');
    $modal.modal('show');
    $.ajax({
        url: '/?action=phone-edit&id=' + phoneId,
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
}

$('.phone-add').on("click", function () {
    showPhoneForm();
});

$('.phone-edit').on("click", function () {
    let phoneId = $(this).data('phone_id');
    showPhoneForm(phoneId);
});

$(document).on("submit", '#phone-form', function () {
    let $form = $(this);
    let $content = $('#phone-modal .modal-content');
    $.ajax({
        url: $form.prop('action'),
        type: $form.prop('method'),
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