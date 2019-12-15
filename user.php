<?php session_start(); require  'php/func.php';
if (!isset($_SESSION['login'])) Header('Location: sign_in.php?user=false'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Тачка.ру: Личный кабинет</title>
    <link rel="icon" href="pictures/favicon.png">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/css_main.css" rel="stylesheet">
  </head>

  <body>

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
    </header>

    <main role="main">
      <div class="container">
        <div class="row">
            <?php if ((isset($_GET["find"]))) find($_GET) ?>
          <div class="col-md-4 order-md-1" >
          <img  src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Аватарка" width="300" height="300">
            <h3> 
              <?php 
                echo $_SESSION['login'];
              ?>
            </h3>
              <div>
                  <a href="php/logout.php" class="btn btn-secondary">Выйти</a>
          </div>
          </div>
          <div class="col-md-5 order-md-2">
              <?php if (isset($_GET["user"]) and (($_GET["user"]) == "out")) {?>
              <div class="alert alert-warning" role="alert">
                  "Чтобы зарагестрироваться,<br>нужно сначала выйти<br>из личного кабинета."
              </div>
              <?php }?>
               <h2>Секретная информация</h2>
               <table class="table table-inverse">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>email</th>
                      <th>number</th>
                      <th>phone</th>
                        <th>car</th>
                        <th>salon</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td> Для  </td>
                        <td>  вида </td>
                        <td>  наполненности </td>
                        <td>   страницы</td>
                        <td>  а_то_слишком_пусто</td>
                        <td>   она_выглядит)</td>
                    </tr>
                   </tbody>
                </table>
              <div id="map" class="map_user"></div>
          </div>

        </div>

      </div>
        <footer class="container  ">
            <hr class="featurette-divider">
            <p class="float-right">
                <a href="#">На верх</a></p>
            <p>© 2019
        </footer>
    </main>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=b6b3d28e-6fbe-449d-83bf-85602e5abde2&lang=ru_RU" type="text/javascript"></script>
    <script src="js/integration_yandex_map.js" type="text/javascript"></script>
  </body>
</html>