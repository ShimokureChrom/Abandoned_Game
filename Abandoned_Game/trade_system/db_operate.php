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

    $name = mysqli_real_escape_string($mysqli, $name);
    $password = mysqli_real_escape_string($mysqli, $password);

    if($mysqli->connect_error)
    {
        return($mysqli->connect_error);
    }

    $sql = "INSERT INTO `users` (`id`, `name`, `password`, `money`) VALUES (NULL, '$name', '$password', '1000');";
    $mysqli->query($sql);

    $mysqli->close();

    if(!$mysqli)
    {
        return "＊値の登録に失敗しました！";
    }
    else
    {
        return "success";
    }
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

function get_money($user_id)
{
    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        $result["error"] = $mysqli->connect_error;
        return($result);
    }

    $user_id = mysqli_real_escape_string($mysqli, $user_id);
    $sql = "SELECT * FROM users WHERE id='$user_id';";
    $stmt = $mysqli->query($sql);

    $result["money"] = false;

    while($array=$stmt->fetch_array(MYSQLI_ASSOC))
    {
        $result["money"]=$array['money'];
    }

    $mysqli->close();

    if($result["money"])
    {
        $result["error"] = "success";
    }
    else
    {
        $result["error"] = "＊IDが間違っています。";
    }

    return($result);
}

function set_money($user_id, $money)
{
    if($money < 0)
    {
        return "＊金額が足りません！";
    }

    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        return $mysqli->connect_error;
    }

    $user_id = mysqli_real_escape_string($mysqli, $user_id);
    $money = mysqli_real_escape_string($mysqli, $money);
    $sql = "UPDATE users SET money=$money WHERE id='$user_id';";
    $stmt = $mysqli->query($sql);
    
    $mysqli->close();

    if(!$mysqli)
    {
        return "＊値の変更に失敗しました！";
    }
    else
    {
        return "success";
    }
}

function insert_item($user_id, $item_id, $count)
{
    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        return($mysqli->connect_error);
    }

    $user_id = mysqli_real_escape_string($mysqli, $user_id);
    $item_id = mysqli_real_escape_string($mysqli, $item_id);
    $count = mysqli_real_escape_string($mysqli, $count);

    $sql = "INSERT INTO `inventories` (`id`, `user_id`, `item_id`, `count`) VALUES (NULL, '$user_id', '$item_id', '$count');";
    $mysqli->query($sql);

    $mysqli->close();

    if(!$mysqli)
    {
        return "＊値の登録に失敗しました！";
    }
    else
    {
        return "success";
    }
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

function set_item($user_id, $item_id, $count)
{
    if($count < 0)
    {
        return "＊個数が足りません！";
    }

    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        return $mysqli->connect_error;
    }

    $user_id = mysqli_real_escape_string($mysqli, $user_id);
    $item_id = mysqli_real_escape_string($mysqli, $item_id);
    $count = mysqli_real_escape_string($mysqli, $count);
    $sql = "UPDATE inventories SET count='$count' WHERE user_id='$user_id' AND item_id='$item_id';";
    $stmt = $mysqli->query($sql);
    
    $mysqli->close();

    if(!$mysqli)
    {
        return "＊値の変更に失敗しました！";
    }
    else
    {
        return "success";
    }
}

function insert_trade($user_id, $item_id, $price, $count)
{
    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        return($mysqli->connect_error);
    }

    $user_id = mysqli_real_escape_string($mysqli, $user_id);
    $item_id = mysqli_real_escape_string($mysqli, $item_id);
    $price = mysqli_real_escape_string($mysqli, $price);
    $count = mysqli_real_escape_string($mysqli, $count);

    $sql = "INSERT INTO `trades` (`id`, `user_id`, `item_id`, `price`, `count`) VALUES (NULL, '$user_id', '$item_id', '$price', '$count');";
    $mysqli->query($sql);

    $mysqli->close();

    if(!$mysqli)
    {
        return "＊値の登録に失敗しました！";
    }
    else
    {
        return "success";
    }
}

function get_trades()
{
    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        $result["error"] = $mysqli->connect_error;
        return($result);
    }

    $sql = "SELECT * FROM trades;";
    $stmt = $mysqli->query($sql);

    $result["trade"][0]["id"] = "NONE";
    $num = 0;

    while($array=$stmt->fetch_array(MYSQLI_ASSOC))
    {
        $result["trade"][$num]["id"]=$array['id'];
        $result["trade"][$num]["item_id"]=$array['item_id'];
        $result["trade"][$num]["price"]=$array['price'];
        $result["trade"][$num]["count"]=$array['count'];
        $num++;
    }

    $mysqli->close();
    $result["error"] = "success";

    return($result);
}

function delete_trade($trade_id)
{
    $mysqli = new mysqli(host, user, password, database);

    if($mysqli->connect_error)
    {
        $result["error"] = $mysqli->connect_error;
        return($result);
    }

    $trade_id = mysqli_real_escape_string($mysqli, $trade_id);

    $sql = "SELECT * FROM trades WHERE id='$trade_id';";
    $stmt = $mysqli->query($sql);

    while($array=$stmt->fetch_array(MYSQLI_ASSOC))
    {
        $result["user_id"]=$array['user_id'];
    }

    $sql = "DELETE FROM trades WHERE id='$trade_id';";
    $mysqli->query($sql);

    $mysqli->close();
    
    $result["error"] = "success";
    return($result);
}
?>
