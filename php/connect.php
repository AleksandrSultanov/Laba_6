<?php
function connect ()
{
    return new PDO('mysql:host=localhost;dbname=auto1;charset=utf8', 'root', '');
}