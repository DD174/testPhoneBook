<?php
/**
 * Вьюшка списка телефонной книги
 *
 * @var \system\DataProvider $dataProvider
 */

/** @var Phone[] $phones */
$phones = $dataProvider->getItems();

use models\phone\Phone; ?>
<button type="button" class="btn btn-success phone-add">
    Добавить телефон
</button>

<!-- Modal -->
<div class="modal fade" id="phone-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                loading...
            </div>
        </div>
    </div>Z
</div>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">
            <?= \helpers\HtmlHelper::getLinkSort('Имя', Phone::FIELD_NAME, $dataProvider->getCurrentSortForKey(Phone::FIELD_NAME)) ?>
        </th>
        <th scope="col">
            <?= \helpers\HtmlHelper::getLinkSort('Фамилия', Phone::FIELD_SURNAME, $dataProvider->getCurrentSortForKey(Phone::FIELD_SURNAME)) ?>
        </th>
        <th scope="col">Телефон</th>
        <th scope="col">email</th>
        <th scope="col">Фото</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($phones as $phone) {
        ?>
        <tr>
            <td>
                <?= htmlspecialchars($phone->id) ?> /
                <button type="button" class="btn btn-light btn-sm phone-edit" data-phone_id="<?= htmlspecialchars($phone->id) ?>">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-light btn-sm phone-view" data-phone_id="<?= htmlspecialchars($phone->id) ?>">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
            <th><?= htmlspecialchars($phone->name) ?></th>
            <th><?= htmlspecialchars($phone->surname ?: '-') ?></th>
            <td><?= htmlspecialchars($phone->phone) ?></td>
            <td><?= htmlspecialchars($phone->email ?: '-') ?></td>
            <td>
                <?php
                if ($phone->avatar) {
                    ?>
                    <a href="<?= htmlspecialchars($phone->avatar) ?>" target="_blank">
                        <img src="<?= htmlspecialchars($phone->avatar) ?>" alt="Avatar" class="img-thumbnail">
                    </a>
                    <?php
                }
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

