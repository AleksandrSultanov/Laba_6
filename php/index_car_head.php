<?php
session_start();
require  'php/func.php';

if ((isset($_POST["id_car"])))
    $rez = delete_car($_POST["id_car"]);
if (isset($_GET["id_salon"]))
    $table = table_for_cars(htmlspecialchars($_GET["id_salon"]));
else $table = table_for_all('car');