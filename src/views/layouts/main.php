<?php
 use app\core\Application
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/bootstrap.css">
    <title><?php echo $this->title ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php 
        if (Application::isGuest()): ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            </ul>
        <?php elseif(Application::isAdmin()): ?>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/users">Users <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/profile">
                    Profile
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
        </ul>
        <?php else: ?>
             <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/profile">
                        Profile
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>

<div>
    <?php if (Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <p><?php echo Application::$app->session->getFlash('success') ?></p>
        </div>
    <?php endif; ?>
    {{content}}
</div>

</body>
</html>