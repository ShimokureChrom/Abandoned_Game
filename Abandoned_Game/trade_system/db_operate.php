<?php
define("host", "localhost");
define("user", "root");
define("password", "246911");
define("database", "trade_system");

function insert_user($name, $password)
{
    $mysqli = new mysqli(host, user, password, database);

    if(is_null($name) || is_null($password))
    {
        return "名前、もしくはパスワードが無効です！";
    }

    if($mysqli->connect_error)
    {
        return($mysqli->connect_error);
    }

    $sql = "INSERT INTO `users` (`id`, `name`, `password`, `money`) VALUES (NULL, '$name', '$password', '1000');";
    $mysqli->query($sql);

    $mysqli->close();

    return "success";
}

function check_user($user_name, $password)
{
    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        $result["error"] = $mysqli->connect_error;
        return($result);
    }

    $user_name = mysqli_real_escape_string($mysqli, $user_name);
    $password = mysqli_real_escape_string($mysqli, $password);
    $sql = "SELECT * FROM users WHERE name='$user_name' AND password='$password';";
    $stmt = $mysqli->query($sql);

    $result["user_id"] = false;

    while($array=$stmt->fetch_array(MYSQLI_ASSOC))
    {
        $result["user_id"]=$array['id'];
        $result["money"]=$array['money'];
    }

    $mysqli->close();

    if($result["user_id"])
    {
        $result["error"] = "success";
    }
    else
    {
        $result["error"] = "＊ID、もしくはパスワードが間違っています。<br>もう一度入力してください。";
    }

    return($result);
}

function insert_item($user_id, $item_id, $count)
{
    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        return($mysqli->connect_error);
    }

    $sql = "INSERT INTO `inventories` (`id`, `user_id`, `item_id`, `count`) VALUES (NULL, '$user_id', '$item_id', '$count');";
    $mysqli->query($sql);

    $mysqli->close();

    return "success";
}

function get_item($user_id, $item_id)
{
    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        $result["error"] = $mysqli->connect_error;
        return($result);
    }

    $user_id = mysqli_real_escape_string($mysqli, $user_id);
    $item_id = mysqli_real_escape_string($mysqli, $item_id);
    $sql = "SELECT * FROM inventories WHERE user_id='$user_id' AND item_id='$item_id';";
    $stmt = $mysqli->query($sql);

    $result["count"] = "false";

    while($array=$stmt->fetch_array(MYSQLI_ASSOC))
    {
        $result["count"]=$array['count'];
    }

    $mysqli->close();

    if($result["count"] != "false")
    {
        $result["error"] = "success";
    }
    else
    {
        $result["error"] = "Item or User not found";
    }

    return($result);
}
?>
