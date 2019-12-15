<?php
session_start();
require "php/func.php";

if ((isset($_POST["id_salon"])))
    $rez = delete_salon($_POST["id_salon"]);

$table = table_for_all('salon');
