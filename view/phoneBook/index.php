<?php
/**
 * @var \models\phone\Phone[] $phones
 */
?>
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
            Имя
            <i class="fas fa-sort-amount-up-alt"></i>
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
                <!--
                <button type="button" class="btn btn-light btn-sm phone-delete" data-phone_id="<?/*= htmlspecialchars($phone->id) */?>">
                    <i class="fas fa-trash-alt"></i>
                </button>
                -->
            </td>
            <th><?= htmlspecialchars($phone->name . ' ' . $phone->surname) ?></th>
            <td><?= htmlspecialchars($phone->phone) ?></td>
            <td><?= htmlspecialchars($phone->email ?: '-') ?></td>
            <td>...</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

