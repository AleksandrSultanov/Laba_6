<?php require 'php/index_salon_head.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Тачка.ру: Работа с БД (салоны)</title>

    <link rel="icon" href="pictures/favicon.png">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/css_main.css" rel="stylesheet">
    <link href="bootstrap/form-validation.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Тачка.ру <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index_car.php">Автомобили<span class="sr-only">(current)</span></a>
            </li>
            <?php if (!isset($_SESSION["login"])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="sign_in.php">Войти <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>
            <?php if (isset($_SESSION["login"])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="user.php"><?php echo $_SESSION['login']; ?><span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>
        </ul>
        <form class="form-inline mt-md-0">
            <input class="form-control mr-sm-2" type="text" name="find" placeholder="Поиск" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
        </form>

    </div>
</nav>
<main role="main">

    <div class="container-fluid">
        <div class="row">
            <?php require "php/head_table_salon.php"; ?>
                <ul class="list-group mb-3">
                    <?php if ($table) make_table_for_salon($table)?>
                </ul>
                <div class="col-md-8 offset-md-3">
                    <a href="salon_add.php" class="btn btn-primary offset-11" id="add_salon">Добавить</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="container">
        <hr class="featurette-divider">
        <p class="float-right">
            <a href="#">На верх</a></p>
        <p>© 2019
    </footer>
</main>
</main>

<form hidden id="salon_delete" method="POST">
    <input name="id_salon" id="id_salon">
</form>

<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/delete_salon.js"></script>

</body>
</html>