<?php
/**
 * Форма для добавления/редактирования телефонного номера
 *
 * @var \models\phone\PhoneForm $phoneForm
 * @var string[] $errors
 * @var string[] $info
 */
?>

<form id="phone-form" action="/?action=phone-edit&id=<?= htmlspecialchars($phoneForm->id) ?>" method="post">
    <div class="modal-header">
        <h5 class="modal-title">
            <?php
            if ($phoneForm->id) {
                ?> Редактирование номера <b><?= htmlspecialchars($phoneForm->getOriginPhoneModel()->phone) ?></b><?php
            } else {
                ?>Добавление номера<?php
            }
            ?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <?= \helpers\HtmlHelper::getErrorAlert($errors) ?>
        <?= \helpers\HtmlHelper::getInfoAlert($info) ?>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input name="<?= $phoneForm::FIELD_PHONE ?>" value="<?= htmlspecialchars($phoneForm->phone) ?>"
                   type="text" class="form-control" id="phone" aria-describedby="phoneHelp"
                   placeholder="Телефон" required>
            <small id="phoneHelp" class="form-text text-muted">Номер телефона в любом формате (лишние
                символы будут удалены)</small>
        </div>
        <div class="form-group">
            <label for="name">Имя</label>
            <input name="<?= $phoneForm::FIELD_NAME ?>" value="<?= htmlspecialchars($phoneForm->name) ?>"
                   type="text" class="form-control" id="name" placeholder="Имя" required>
        </div>
        <div class="form-group">
            <label for="surname">Фамилия</label>
            <input name="<?= $phoneForm::FIELD_SURNAME ?>" value="<?= htmlspecialchars($phoneForm->surname) ?>"
                   type="text" class="form-control" id="name" placeholder="Фамилия">
        </div>
        <div class="form-group">
            <label for="email">Имя</label>
            <input name="<?= $phoneForm::FIELD_EMAIL ?>" value="<?= htmlspecialchars($phoneForm->email) ?>"
                   type="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="file">Avatar</label>
            <input name="<?= $phoneForm::FIELD_AVATAR ?>" type="file" class="form-control-file" id="file">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>

