<?php require 'php/car_edit_head.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Тачка.ру: Работа с БД (автомобили)</title>

    <!-- Bootstrap core CSS -->
    <link rel="icon" href="pictures/favicon.png">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/css_main.css" rel="stylesheet">
    <link href="bootstrap/form-validation.css" rel="stylesheet">
    <!-- Custom styles for this template -->
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
                <a class="nav-link" href="index_salon.php">Салоны<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index_car.php">Автомобили<span class="sr-only">(current)</span></a>
            </li>

            <?php if (!isset($_SESSION["login"])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="signin.php">Войти <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>
            <?php if (isset($_SESSION["login"])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="user.php"><?php echo $_SESSION['login']; ?><span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
<main role="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <h4 class="mb-3">Изменить автомобиль</h4>
                <form class="needs-validation" novalidate  enctype="multipart/form-data" method = "POST">

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1">Автосалон</label>
                        <select name="id_salon" class="form-control" id="exampleFormControlSelect1" autofocus>

                            <?php foreach ($table as $salon) {?>
                                <option <?php if((isset($_GET["id_salon"])) and ($_GET["id_salon"] == $salon["id_salon"])
                                    or ((isset($_GET["mark"]) and ($_GET["mark"] == $salon["mark"])))) echo "selected" ?>
                                value="<?php  echo $salon["id_salon"] ?>"><?php echo $salon["mark"] ?></option>
                            <?php } ?>

                        </select>
                        <div class="invalid-feedback">
                            Выберите автосалон.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mark">Марка</label>
                        <input type="text" class="form-control" value="<?php echo $row["mark"]?>" name="mark" placeholder="Roadster" required maxlength = "32" pattern="\w*">
                        <div class="invalid-feedback">
                            Марка машины введена не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="model">Модель</label>
                        <input type="text" class="form-control" value="<?php if(isset($row["model"])) echo $row["model"]?>" name="model" placeholder="Roadster" required maxlength = "32" pattern="\w*">
                        <div class="invalid-feedback">
                            Модель машины введена не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="year">Год производства</label>
                        <input type="text" class="form-control" value="<?php echo $row["production_year"]?>" name="year" placeholder="2019" required maxlength = "4"  pattern="\d*">
                        <div class="invalid-feedback">
                            Год введен не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="number">Стоимость</label>
                        <input type="text" class="form-control" value="<?php echo $row["cost"]?>" name="cost" placeholder="10  000 000 ₽" required maxlength = "32" pattern="\d*">
                        <div class="invalid-feedback">
                            Стоимость введена не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mileage">Пробег</label>
                        <input type="text" class="form-control" value="<?php echo $row['mileage']?>" name="mileage" placeholder="0 км" required maxlength = "11" pattern="\d*">
                        <div class="invalid-feedback">
                            Пробег введен не верно.
                        </div>
                    </div>

                    <div class="mb-3 custom-file">
                        <input type="file" name="user_file"  class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Выберите файл</label>
                        <div class="invalid-feedback">
                            Добавьте изображение.
                        </div>
                    </div>

                    <?php if($row['file_path'] != "0") { ?>
                        <picture>
                            <label for="image">Текущее изображение</label><br>
                            <source  type="image/svg+xml">
                            <img src="<?php echo $row['file_path']?>" class="img-fluid img-thumbnail" width="100"  alt="..."><br><br>
                        </picture>
                    <?php } ?>

                    <input class="btn btn-primary btn-lg btn-block" name="check" value="Сохранить автомобиль" type="submit">
                </form>
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

<form hidden id="car_delete" method="POST">
    <input name="id_car" id="id_car">
</form>

<script type="text/javascript" src="js/validate.js" ></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/delete_car.js"></script>
</body>
</html>