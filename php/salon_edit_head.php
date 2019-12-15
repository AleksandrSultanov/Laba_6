<?php
session_start();
require  'php/func.php';

$row = row("salon", htmlspecialchars($_GET["id_salon"]));

if ((isset($_POST['check'])) && (isset($_POST['mark'])) && (isset($_POST['tel'])) && (isset($_POST['email'])))
{
    $salon = salon_array($_POST);
    $rez1 = edit_check(htmlspecialchars($_GET["id_salon"]), "salon");
    $rez2 = save_salon($salon, $_FILES["user_file"], "salon", htmlspecialchars($_GET["id_salon"]));
    header("Location: index_salon.php?edit1=$rez1&edit2=$rez2");
}
