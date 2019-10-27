<?php
/**
 * Просмотре записи в модалке
 *
 * @var \models\phone\Phone|null $phone
 */

if (!$phone) {
    ?>
    Номер не найден
    <?php

    return;
}
?>
<div class="modal-header">
    <h5 class="modal-title">
        Просмотр номера <?= htmlspecialchars($phone->phone) ?>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table">
        <tbody>
        <tr>
            <td>Имя</td>
            <th scope="row"><?= htmlspecialchars($phone->name) ?></th>
        </tr>
        <tr>
            <td>Фамилия</td>
            <th scope="row"><?= htmlspecialchars($phone->surname) ?></th>
        </tr>
        <tr>
            <td>Телефон</td>
            <th scope="row">
                <?= htmlspecialchars($phone->phone) ?>
                <br>
                <span class="font-weight-normal">
                    <?= htmlspecialchars(\helpers\HtmlHelper::phoneNumberToWords($phone->phone)) ?>
                </span>
            </th>
        </tr>
        <tr>
            <td>Почта</td>
            <th scope="row"><?= htmlspecialchars($phone->email) ?></th>
        </tr>
        <tr>
            <td>Картинка</td>
            <th scope="row">2</th>
        </tr>
        </tbody>
    </table>
</div>