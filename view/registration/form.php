<?php
/**
 * @var \models\user\User|null $user
 * @var string[] $errors
 */

if ($user) {
    ?>
    Пользователь успешно создан
    <?php
    return;
}

if ($errors) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?= implode('<br>', $errors) ?>
    </div>
    <?php
}

?>
<form action="" method="post">
    <div class="form-group">
        <label for="login">Login</label>
        <input name="login" type="text" class="form-control" id="login" aria-describedby="loginHelp" placeholder="Enter login">
        <small id="loginHelp" class="form-text text-muted">Только английские буквы</small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted"> </small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="password" type="text" class="form-control" id="exampleInputPassword1" aria-describedby="passwordHelp" placeholder="Password">
        <small id="passwordHelp" class="form-text text-muted">Это тестовое приложение! Пароль хранится в отрытом виде!</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>