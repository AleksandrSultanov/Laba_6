<?php
session_start();
require 'php/func.php';
$table = table_for_all("salon");

if ((isset($_POST['check'])) && (isset($_POST['model']))) {
    $id_salon = $_POST["id_salon"];
    $mark = $_POST["mark"];
    $rez = add_car($_POST, $_FILES["user_file"], "car");
    header("Location: index_car.php?id_salon=$id_salon&mark=$mark&rez=$rez");
}
