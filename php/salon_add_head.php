<?php
session_start();
require  'php/func.php';

if ((isset($_POST['check'])) && (isset($_POST['mark'])) && (isset($_POST['tel'])) && (isset($_POST['email'])))
{
    $rez1 = add_salon($_POST, $_FILES["user_file"],'salon');
    header("Location: index_salon.php?add=$rez1");
}
