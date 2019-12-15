<?php
session_start();
require 'php/func.php';
$table = table_for_all("salon");
$row = row("car", htmlspecialchars($_GET["id_car"]));

if ((isset($_POST['check'])) && (isset($_POST['model'])) && isset($_GET['mark'])) {
    $rez = save_car($_POST, $_GET, $_FILES["user_file"], "car");
    if (isset($_GET["id_salon"])){
        $id_salon = $_GET["id_salon"];
        $mark = $_POST["mark"];
        header("Location: index_car.php?id_salon=$id_salon&mark=$mark&edit=$rez");}
    else
        header("Location: index_car.php?edit=$rez");
}
?>