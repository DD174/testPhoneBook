<?php
/**
 * @var string $content
 */
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
<style type="text/css">
    body {
        padding-top: 5rem;
    }
</style>
    <title>Title :)</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Phone Book</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/?action=registration">Registration</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/?action=logout"><span class="fas fa-sign-out-alt">&nbsp;</span>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">

    <?= $content ?>

</main>
<script src="/assets/jquery/jquery-3.4.1.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/phone.js"></script>
</body>
</html>