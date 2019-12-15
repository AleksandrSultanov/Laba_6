<?php
require 'connect.php';

function add_salon ($POST, $FILES, $db_name)
{
    $object = salon_array($POST);
    $connect = connect();

    $object["file_path"] = add_file($FILES, $db_name, 0);
    if ($object["file_path"] == -1)
        return -1;

    $row = 'NULL,';
    foreach ($object as $name => $value)
        $row .= ":$name,";
    $row = substr($row, 0, -1);

    $query = "INSERT INTO $db_name VALUES ($row)";
    if (!$connect->prepare($query)->execute($object))
        return -1;

    return 1;
}

function add_car ($POST, $FILES, $db_name)
{
    $connect = connect();

    $object = car_array($POST);
    $id_salon = htmlspecialchars($POST["id_salon"]);
    $object["file_path"] = add_file($FILES, "car", 0);
    if ($object["file_path"] == -1)
        return -1;

    $row = 'NULL,';
    foreach ($object as $name => $value)
        $row .= ":$name,";
    $row = substr($row, 0, -1);

    $query = "INSERT INTO $db_name VALUES ($row)";
    $rez1 = $connect->prepare($query)->execute($object);
    $id_car = $connect->lastInsertId();

    $query = "INSERT INTO relation (id_salon, id_car) VALUES ($id_salon   , $id_car)";
    $rez2 = $connect->prepare($query)->execute();
    $connect = null;
    if (!$rez1 or !$rez2)
        return -1;
    return 1;
}

function add_file ($FILES, $db_name, $id)
{
    define("upload_dir",'user_file/');

    if ($FILES["error"] !== UPLOAD_ERR_OK)
        return -1;

    $file_type = exif_imagetype($FILES["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($file_type, $allowed))
        return -1;

    if ($id != 0)
        delete_file($db_name, $id);

    $FILES["name"] = preg_replace("/[^A-Z0-9._()-]/i", '_', $FILES["name"]);

    $i = 0;
    $parts = pathinfo($FILES["name"]);
    while (file_exists(upload_dir.$FILES["name"]))
    {
        $i++;
        $FILES["name"] = $parts["filename"]. "_" . "(" . $i . ")".  "." . $parts["extension"];
    }

    $upload_file = upload_dir.basename($FILES['name']);
    if (!move_uploaded_file($FILES["tmp_name"], $upload_file))
        return -1;
    chmod($upload_file, 0644);
    return $upload_file;
}

function delete_file($db_name, $id)
{
    $connect = connect();
    $query = "SELECT * FROM $db_name WHERE id_$db_name=$id";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row["file_path"] != "0")
        unlink($row["file_path"]);
}

function save_salon($object, $FILES, $db_name, $id)
{
    if ($FILES["name"] == "") {
        delete_file($db_name, $id);
        $object["file_path"] = 0;
    }
    else {
        $object["file_path"] = add_file($FILES, $db_name, $id);
        if ($object["file_path"] == -1)
            return -1;
    }

    $row = '';
    foreach ($object as $key => $value)
        $row .= "$key=:$key, ";
    $row = substr($row, 0, -2);

    $connect = connect();
    $query = "UPDATE $db_name SET $row WHERE id_$db_name=$id";
    $rez = $connect->prepare($query)->execute($object);
    $connect = null;
    if (!$rez)
        return -1;
    return 1;
}


function save_car($POST, $GET, $FILES, $db_name)
{
    $object = car_array($POST);
    $id_car = htmlspecialchars($GET["id_car"]);
    $id_salon = htmlspecialchars($POST["id_salon"]);
    if ($FILES["name"] == "") {
        delete_file($db_name, htmlspecialchars($GET["id_car"]));
        $object["file_path"] = 0;
    }
    else {
        $object["file_path"] = add_file($FILES, $db_name, $id_car);
        if ($object["file_path"] == -1)
            return -1;
    }

    $row = '';
    foreach ($object as $key => $value)
        $row .= "$key=:$key, ";
    $row = substr($row, 0, -2);

    $connect = connect();
    $query = "UPDATE $db_name SET $row WHERE id_$db_name=$id_car";

    $connect->prepare($query)->execute($object);

    $query = "UPDATE relation SET id_salon=$id_salon WHERE id_car=$id_car";

    $rez2 = $connect->prepare($query)->execute();
    $connect = null;
    if (!$rez2)
        return -1;

    return 1;
}

function delete_car($id)
{
    $id = htmlspecialchars($id);
    $connect = connect();

    delete_file("car", $id);

    $query = "DELETE FROM car WHERE id_car=$id";
    $rez1 = $connect->prepare($query)->execute();

    $query = "DELETE FROM relation WHERE id_car=$id";
    $rez2 = $connect->prepare($query)->execute();

    $connect = null;
    if (!$rez1 or !$rez2)
        return -1;
    return 1;
}

function delete_salon($id)
{
    $id = htmlspecialchars($id);
    $connect = connect();

    $query = "SELECT * FROM relation WHERE id_salon=$id";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $check = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$check)
    {
        delete_file("salon", $id);
        $query = "DELETE FROM salon WHERE id_salon=$id";
        $connect->prepare($query)->execute();
        $connect = null;
        return 1;
    }

    if ($check)
    {
        $connect = null;
        return -1;
    }

    $connect = null;
    return -1;
}

function table_for_all ($db_name)
{
    $data = array();
    $connect = connect ();
    foreach ($connect->query("SELECT * FROM $db_name") as $row)
        $data[$row["id_$db_name"]] = $row;
    $connect = null;
    return $data;
}

function table_for_cars ($id_salon)
{
    $connect = connect();
    $query = "SELECT * FROM relation WHERE id_salon=$id_salon";
    foreach ($connect->query($query) as $row)
    {
        $query2 = "SELECT * FROM car WHERE id_car=$row[2]";
        foreach ($connect->query($query2) as $row2)
            $data[$row2[0]] = $row2;
    }
    $connect = null;
    if (isset($data))
        return $data;
}

function row($db_name, $id)
{
    $connect = connect();
    $query = "SELECT * FROM $db_name WHERE id_$db_name=$id";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
    $connect = null;
    return $edit;
}

function salon_array($POST)
{
    $salon = array();
    $salon['mark']       = htmlspecialchars($POST['mark']);
    $salon['number']     = htmlspecialchars($POST['tel']);
    $salon['email']      = htmlspecialchars($POST['email']);
    $salon['file_path']  = "";
    return $salon;
}

function car_array($POST)
{
    $car = array();
    $car['mark']            = htmlspecialchars($POST['mark']);
    $car['model']           = htmlspecialchars($POST['model']);
    $car['production_year'] = htmlspecialchars($POST['year']);
    $car['cost']            = htmlspecialchars($POST['cost']);
    $car['mileage']         = htmlspecialchars($POST['mileage']);
    $car['file_path']       = "";
    return $car;
}

function id_salon($mark)
{
    $connect = connect();
    $query = "SELECT * FROM salon WHERE mark = '$mark'";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
    $connect = null;
    return $edit["id_salon"];
}

function edit_check ($id, $db_name)
{
    $connect = connect ();
    foreach ($connect->query("SELECT * FROM $db_name") as $row)
        if ($row["id_$db_name"] == $id)
            return 1;
    return -1;
}

function find($GET)
{
    $find = htmlspecialchars($GET["find"]);
    if (strlen($find)>0)
    {
        $find_salon = find_salon($find);
        $find_car = find_car($find);
        if (count($find_salon) != 0){
            echo '            <div class="col-md-8 offset-md-2 mb-6">
                <h4 class="justify-content-between align-items-center mb-3">
                    <span class="text">Результат поиска по автосалонам</span>
                    <span class="badge badge-secondary badge-pill">' .count($find_salon).'</span>
                </h4>',
            make_table_for_salon($find_salon), ' 
            </div>';
            }
        if (count($find_car) != 0) {
            echo '            <div class="col-md-8 offset-md-2 mb-6">
                <h4 class="justify-content-between align-items-center mb-3">
                    <span class="text">Результат поиска по автомобилям</span>
                    <span class="badge badge-secondary badge-pill">', count($find_car), '</span>
                </h4>',
            make_table_for_car($find_car, $GET), '
            </div>';
        }
        if (((count($find_salon) == 0)) and (count($find_car) == 0))
            echo ' <div class="col-md-8 offset-md-2 alert alert-warning container" role="alert">
                          <h5>Ничего не найдено!</h5>  
                   </div>';
    }
    return 0;
}

function find_salon($str)
{
    $connect = connect ();

    $sql = ("SELECT * FROM salon WHERE mark LIKE '%".
            preg_replace("# #msi", "%' OR `mark` LIKE '%", $str). "%' ORDER BY mark");
    $statement = $connect->prepare($sql);
    $statement->execute();
    $salon = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $salon;
}

function find_car($str)
{
    $connect = connect ();

    $sql = ("SELECT * FROM car WHERE mark LIKE '%".
            preg_replace("# #msi", "%' OR `mark` LIKE '%", $str)."%'");
    $statement = $connect->prepare($sql);
    $statement->execute();
    $car = $statement->fetchAll(PDO::FETCH_ASSOC);

    $sql = ("SELECT * FROM car WHERE model LIKE '%".
        preg_replace("# #msi", "%' OR `model` LIKE '%", $str)."%'");
    $statement = $connect->prepare($sql);
    $statement->execute();
    $car += $statement->fetchAll(PDO::FETCH_ASSOC);
    return $car;
}

function make_table_for_salon($table)
{
     echo  '<table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Марка</th>
                <th scope="col">Номер</th>
                <th scope="col">Email</th>
                <th scope="col">Изображение</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>';
     $count = 1;
     foreach ($table as $key => $row) {
         echo '<tr>
                <th scope="row">';
         echo $count++;
         echo '</th>
                        <td><a href="index_car.php?mark=' .$row['mark']. '&id_salon='. $row['id_salon']. '">'.$row['mark'].'</a></td>
                        <td>'.$row['number'].'</td>
                        <td>'.$row['email'].'</td>';
         if ($row['file_path'] != "0")
             echo '<td><img src="'.$row['file_path'].'" class="img-thumbnail"  width="150" alt="Responsive image"></td>';
         else
             echo '<td></td>';
         echo '<td>
                    <div class="btn-group">
                        <a href="salon_edit.php?id_salon='.$row['id_salon'].'" class="btn btn-warning">Изменить</a>
                        <button type="button" data-id_salon="'.$row["id_salon"].'" class="btn btn-danger" id="delete_btn">Удалить</button>
                    </div>
                </td>
            </tr>';
         }
         echo '</tbody> </table>';
}

function make_table_for_car($table, $GET)
{
    echo '<table class="table">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Марка</th>
                            <th scope="col">Модель</th>
                            <th scope="col">Год</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Пробег</th>
                            <th scope="col">Изображение</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>';
    $count = 1;
    foreach ($table as $key => $row) {
                            echo '<tr>
                                <th scope="row">';
                            echo $count++;
                            echo '</th>
                                <td><a href="index_car.php?mark=';
                            echo $row['mark']. '&id_salon=' .id_salon($row['mark']). ' ">' .$row['mark']. '</a></td>
                                <td>' .$row['model']. '</td>
                                <td>' .$row['production_year']. '</td>
                                <td>' .$row['cost']. '</td>
                                <td>' .$row['mileage']. '</td>';
                            if ($row['file_path'] != "0")
                                echo '<td><img src="' .$row['file_path']. '" class="img-thumbnail" width="150"  alt="Responsive image"></td>';
                            else
                                echo '<td></td>';
                            echo '<td>
                                    <div class="btn-group">
                                        <a href="car_edit.php?mark=' .$row['mark']. '&id_car=' .$row['id_car'];
                            if (isset($GET["id_salon"])) echo ' "&id_salon=" '.$GET["id_salon"];
                            echo '" class="btn btn-warning">Изменить</a>
                                        <button type="button" data-id_car="' .$row["id_car"]. '?>" class="btn btn-danger" id="delete_btn">Удалить</button>
                                    </div>
                                </td>
                            </tr>';
                         }
echo '</tbody>
</table>';
}

function sign_in($POST)
{
    if (isset($POST["login"]) and isset($POST["password"]))
    {
        $connect = connect ();
        $login = $POST['login'];
        $password = $POST['password'];

        $query = "SELECT * FROM users WHERE login = '$login'";
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user)
        {
            $connect = null;
            return "Пользователь не найден!";
        }

        if (($user["login"] == $login) and (password_verify($password, $user["password"]))) {
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            $_SESSION['status'] = 1;
            $connect = null;
            Header('Location: user.php');
        }
        else {
            $connect = null;
            return "Неверный логин или пароль!";
        }
        }
}

function registration ($POST)
{
    if (isset($POST["login"]) and isset($POST["password1"]) and isset($POST["password2"]))
    {
        if ($POST["login"] != htmlspecialchars($POST["login"]))
            return "Логин не подходит.";
        if ($POST["password1"] != $POST["password2"])
            return "Пароли не совпадают!";

        $connect = connect ();
        $login = $POST['login'];
        $password = password_hash($POST['password1'], PASSWORD_DEFAULT);

        $query = "SELECT * FROM users WHERE login = '$login'";
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user)
        {
            $connect = null;
            return "Логин занят!";
        }

        $query = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
        $rez = $connect->prepare($query)->execute();
        if (!$rez)
            return "Ошибка при регистрации пользователя!";

        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['check'] = 1;
        $connect = null;
        Header('Location: user.php');
    }
}

