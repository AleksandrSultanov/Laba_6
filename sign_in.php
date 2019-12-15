<?php session_start(); require  'php/func.php';
if (isset($_POST["login"]) and isset($_POST["password"])) $msg = sign_in($_POST);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="pictures/favicon.png">

    <title>Тачка.ру: Вход на сайт</title>
      <link rel="icon" href="pictures/favicon.png">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/css_main.css" rel="stylesheet">
    <link href="bootstrap/signin.css" rel="stylesheet">
    <link href="bootstrap/form-validation.css" rel="stylesheet">
  </head>

  <body class="text-center">
        <header>
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
            </ul>

        </div>
      </nav>
    </header>
    <form class="needs-validation" novalidate method = "POST">

      <h1 class="h3 mb-3 font-weight-normal">Пожалуйста войдите</h1>
      <?php if (isset($msg)) {?>
      <div class="alert alert-danger" role="alert">
      <?php echo $msg; } ?>
      <?php if (isset($_GET["user"]) and (($_GET["user"]) == "false")) {?>
      <div class="alert alert-warning" role="alert">
          <?php echo "Страница доступна только<br>авторизированным пользователям!"; } ?>
      </div>
      <input type="text" name="login"  pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,14}$" class="form-control" placeholder="Логин" required autofocus>
          <div class="invalid-feedback">
              Строчные и прописные латинские буквы,<br>цифры, длина 6-15 символов
          </div>
      <input type="password" name="password" id="inputPassword" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" class="form-control" placeholder="Пароль" required>
          <div class="invalid-feedback">
              Строчные и прописные латинские буквы,<br>цифры, спецсимволы, минимум 8 символов
          </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
          <label>Впервые на Тачка.ру?</label><br>
          <a href="registration.php" class="btn btn-success" id="registr">Зарегестрироваться</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
    </form>
  </body>
  <script type="text/javascript" src="js/validate.js" ></script>
</html>