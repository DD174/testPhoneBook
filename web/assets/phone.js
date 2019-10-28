/**
 *
 */
function showPhoneModal(phoneId = '', action = 'phone-edit') {
    let $modal = $('#phone-modal');
    let $content = $('#phone-modal .modal-content');
    $content.html('Loading...');
    $modal.modal('show');
    $.ajax({
        url: '/?action=' + action + '&id=' + phoneId,
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
    showPhoneModal();
});

$('.phone-edit').on("click", function () {
    let phoneId = $(this).data('phone_id');
    showPhoneModal(phoneId);
});

$('.phone-view').on("click", function () {
    let phoneId = $(this).data('phone_id');
    showPhoneModal(phoneId, 'phone-view');
});

$(document).on("submit", '#phone-form', function () {
    let $form = $(this);
    let $content = $('#phone-modal .modal-content');
    let formData = new FormData($form.get(0));
    $.ajax({
        url: $form.prop('action'),
        type: $form.prop('method'),
        dataType: 'html',
        processData: false,
        contentType: false,
        data: formData
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