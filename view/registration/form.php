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

<form id="form-registration" action="" method="post" novalidate>
    <div class="form-group">
        <label for="login">Login</label>
        <input name="login" type="text" class="form-control" id="login" placeholder="Enter login"
               pattern="<?= \models\user\UserService::REGEXP_LOGIN ?>" required/>
        <div class="invalid-feedback">
            Логин обязателен и должен состоять только из латинских букв и цифр
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
        <div class="invalid-feedback">
            Email обязателен, и пишите его правильно
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="password" type="text" class="form-control" id="exampleInputPassword1" aria-describedby="passwordHelp" placeholder="Password" required
            pattern="<?= \models\user\UserService::REGEXP_PWD ?>">
        <small id="passwordHelp" class="form-text text-muted">Это тестовое приложение! Пароль хранится в отрытом виде!</small>
        <div class="invalid-feedback">
            Пароль должен содержать и цифры и латинские буквы
        </div>
    </div>
    <div class="form-group">
        <label for="captcha"><?= htmlspecialchars($captcha->getQuestion()) ?></label>
        <input name="answer" type="text" class="form-control" id="captcha" aria-describedby="captchaHelp" placeholder="Ответ" required>
        <div class="invalid-feedback">
            Решите пример, чтобы зарегистрироваться
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script type="text/javascript">
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            let form = document.getElementById('form-registration');
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
</script>