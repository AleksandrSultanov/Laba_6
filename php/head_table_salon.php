<?php if ((isset($_GET["find"]))) {find($_GET); echo "<br><br><br>";}  ?>
            <div class="col-md-8 offset-md-2 mb-6">
                <h4 class="justify-content-between align-items-center mb-3">
                    <?php if(!$table){?>
                        <div class="alert alert-warning container" role="alert">
                            Добавленных автосалонов пока нет!
                        </div>
                    <?php } else ?>
                    <span class="text">Добавленные автосалоны</span>
                    <span class="badge badge-secondary badge-pill"><?php echo count($table);?></span>
                </h4>
                <?php if ((isset($_GET['edit1']) and ($_GET['edit1'] == "1")) and (isset($_GET['edit2']) and ($_GET['edit2'] == "1")) and (!isset($rez))){ ?>
                    <div class="alert alert-success" role="alert">
                        Действие произошло успешно!
                    </div>
                <?php } ?>
                <?php if((((isset($_GET['add'])) and ($_GET['add'] == 1))) and (!isset($rez))) { ?>
                <div class="alert alert-success" role="alert">
                    Действие произошло успешно!
                </div>
                <?php } ?>
                <?php if(isset($rez) and ($rez == 1)) { ?>
                    <div class="alert alert-success" role="alert">
                        Удаление произошло успешно.
                    </div>
                <?php } ?>
                <?php if ((isset($rez)) and ($rez == -1)) { ?>
                    <div class="alert alert-danger" role="alert">
                        Действие произошло с ошибкой!
                        Нельзя удалить связный объект.
                        Сначала удалите все автомобили в автосалоне.
                    </div>
                <?php } ?>
                <?php if ((isset($_GET["edit1"])) and ($_GET["edit1"] == -1) or (isset($_GET["edit2"])) and ($_GET["edit2"] == -1)) { ?>
                    <div class="alert alert-danger" role="alert">
                        Произошла ошибка при изменении автосалона!
                    </div>
                <?php } ?>
                <?php if ((isset($_GET["add"])) and ($_GET["add"] == -1)) { ?>
                    <div class="alert alert-danger" role="alert">
                        Произошла ошибка при добавления автосалона!
                    </div>
                <?php } ?>