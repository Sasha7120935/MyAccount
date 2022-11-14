<?php

namespace Classes;

class Databases
{

    public static function insert($name, $surname, $email, $age, $photo)
    {
        include 'connection.php';
        if (!empty($name && $surname && $email && $age && $photo)) {
            $query = "INSERT INTO users (name,surname,email,age,photo) VALUES ('" . $name . "','" . $surname . "','" . $email . "','" . $age . "','" . $photo . "')";
            mysqli_query($db, $query);
        } else {
            echo 'Error in updating Database';
            exit();
        }
    }

    public static function row($id)
    {
        include 'connection.php';
        if (!empty($id)) {
            $query = mysqli_query($db, "SELECT * FROM users where user_id='$id'");
        } else {
            die(mysqli_error());
        }
        return mysqli_fetch_array($query);
    }

    public static function update($name, $surname, $age, $email, $target, $id)
    {
        include 'connection.php';
        if (!empty($name && $surname && $email && $age && $target && $id)) {
            $query = "UPDATE users SET name = '$name', surname = '$surname', age = '$age', email = '$email', photo ='$target' WHERE user_id = '$id'";
        } else {
            die(mysqli_error($db));
        }
        return mysqli_query($db, $query);

    }


}