<?php if ((isset($_GET["find"]))) find($_GET) ?>
<div class="col-md-8 offset-md-2">
    <h4 class="justify-content-between align-items-center mb-3">
        <?php if(!$table){?>
            <div class="mb-3">
                <div class="alert alert-warning " role="alert">
                    Добавленных автомобилей пока нет!<br>
                    Либо несущесвтует автосалон.
                </div>
            </div>
        <?php } else { if (!isset($_GET["mark"])) {?>
            <span class="text">Все добавленные автомобили</span>
        <?php } else { ?>
            <span class="text">Добавленные автомобили в <?php echo $_GET["mark"]; ?></span>
        <?php } ?>
        <span class=" badge badge-secondary badge-pill"><?php echo count($table);?></span>
    </h4>
    <div class="mb-3">
        <?php if ((isset($rez1) and ($rez1 === 1)) and (!isset($rez))) {  ?>
            <div class="alert alert-success" role="alert">
                Действие произошло успешно!
            </div>
        <?php } ?>
        <?php if ((((isset($_GET["edit"])) and ($_GET["edit"] == "1")) or ((isset($_GET["rez"] )) and ($_GET["rez"] == "1"))) and (!isset($rez))) {  ?>
            <div class="alert alert-success" role="alert">
                Действие произошло успешно!
            </div>
        <?php } ?>
        <?php if (((((isset($_GET["edit"] )) and ($_GET["edit"] == "-1")) or ((isset($_GET["rez"] )) and ($_GET["rez"] == "-1")))) and (!isset($rez))) { ?>
            <div class="alert alert-danger" role="alert">
                Действие произошло с ошибкой!
            </div>
        <?php } ?>
        <?php if(isset($rez) and ($rez == 1)) { ?>
            <div class="alert alert-success" role="alert">
                Удаление произошло успешно.
            </div>
        <?php } ?>
        <?php if ((isset($rez)) and ($rez == -1)) { ?>
            <div class="alert alert-danger" role="alert">
                Удаление произошло с ошибкой!
            </div>
        <?php } ?>
        <?php } ?>
    </div>