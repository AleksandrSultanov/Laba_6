<?php
session_start();
require  'php/func.php';
if (isset($_SESSION['login'])) Header('Location: user.php?user=out');
if (isset($_POST["login"]) and isset($_POST["password1"]) and isset($_POST["password2"]))
    $msg = registration($_POST);
