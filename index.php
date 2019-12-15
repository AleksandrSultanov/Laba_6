<?php session_start(); require  'php/func.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <title>Тачка.ру: Покупка и продажа автомобилей.</title>

    <link rel="icon" href="pictures/favicon.png">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/css_main.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
      <div class="container marketing">
        <div class="row">

          <div class="col-lg-2">
            <img src="pictures/lada.jpg" alt="Generic placeholder image" width="140" height="140">
            <p>Lada</p>
            <p><a class="btn btn-secondary" href="#" role="button">Подробнее »</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-2">
            <img src="pictures/toyota.jpg" alt="Generic placeholder image" width="140" height="140">
            <p>Toyota</p>
            <p><a class="btn btn-secondary" href="#" role="button">Подробнее »</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-2">
            <img src="pictures/nissan.jpg" alt="Generic placeholder image" width="140" height="140">
            <p>Nissan</p>
            <p><a class="btn btn-secondary" href="#" role="button">Подробнее »</a></p>
          </div><!-- /.col-lg-4 -->
         <div class="col-lg-2">
            <img src="pictures/hyundai.jpg" alt="Generic placeholder image" width="140" height="140">
            <p>Hyundai</p>
            <p><a class="btn btn-secondary" href="#" role="button">Подробнее »</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-2">
            <img src="pictures/kia.jpg" alt="Generic placeholder image" width="140" height="140">
            <p>Kia</p>
            <p><a class="btn btn-secondary" href="#" role="button">Подробнее »</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-2">
            <img src="pictures/renault.jpg" alt="Generic placeholder image" width="140" height="140">
            <p>Renault</p>
            <p><a class="btn btn-secondary" href="#" role="button">Подробнее »</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <?php if ((isset($_GET["find"]))) find($_GET) ?>
          <div class="col-md-5">
            <h2 class="featurette-heading">Kia <span class="text-muted">Rio</span></h2>
            <p class="lead">Уже большой, еще не взрослый</p>
          </div>
          <div class="col-md-7">
            <img class="featurette-image img-fluid mx-auto big_pictures" src="pictures/rio.png">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
         
          <div class="col-md-5 order-md-2">
          <a href="toyota_camry.php" >  <h2 class="featurette-heading">Toyota <span class="text-muted">Camry</span></h2>
            <p class="lead">Лучше большинства, но не всех</p> </a>
          </div>
          <div class="col-md-7 order-md-1">
           <a href="toyota_camry.html">  <img class="featurette-image img-fluid mx-auto big_pictures" src="pictures/Camry.png"></a>
          </div>

        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-5">
           <h2 class="featurette-heading">Hyundai <span class="text-muted">Solaris</span></h2>
            <p class="lead">Средний был и так и сяк</p>
          </div>
          <div class="col-md-7">
            <img class="featurette-image img-fluid mx-auto big_pictures" src="pictures/Solaris.png">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-5 order-md-2">
           <h2 class="featurette-heading">Volkswagen <span class="text-muted">Polo</span></h2>
            <p class="lead">Игра на повышение</p>
          </div>
          <div class="col-md-7 order-md-1">
            <img class="featurette-image img-fluid mx-auto big_pictures" src="pictures/polo1.png">
          </div>
        </div>

          <div id="map" class="map"></div>

  </div>

      <!-- FOOTER -->
      <footer class="container">
        <hr class="featurette-divider">
        <p class="float-right">
          <a href="#">На верх</a></p>
        <p>© 2019 · <a href="">Политика конфенденциальности</a>
      </footer>
    </main>
</body>
<script src="https://api-maps.yandex.ru/2.1/?apikey=b6b3d28e-6fbe-449d-83bf-85602e5abde2&lang=ru_RU" type="text/javascript"></script>
<script src="js/integration_yandex_map.js" type="text/javascript"></script>
</html>