<?php
/**
 * @var \models\user\User|null $user
 * @var string[] $errors
 * @var \system\Captcha $captcha
 */

if ($user) {
    ?>
    Пользователь успешно создан
    <?php
    return;
}
?>

<?= \helpers\HtmlHelper::getErrorAlert($errors) ?>

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
    <div class="form-group">
        <label for="captcha"><?= htmlspecialchars($captcha->getQuestion()) ?></label>
        <input name="answer" type="text" class="form-control" id="captcha" aria-describedby="captchaHelp" placeholder="Ответ">
        <small id="captchaHelp" class="form-text text-muted">Решите пример, чтобы зарегистрироваться</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>