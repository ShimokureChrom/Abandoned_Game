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
        return($mysqli->connect_error);
    }
    
    $user_name = mysqli_real_escape_string($mysqli, $user_name);
    $password = mysqli_real_escape_string($mysqli, $password);
    $sql = "SELECT * FROM users WHERE name='$user_name' AND password='$password'";
    $stmt = $mysqli->query($sql);

    $result = false;
    
    while($array=$stmt->fetch_array(MYSQLI_ASSOC))
    {
        $result=$array['id'];
    }
    
    $mysqli->close();

    if($result)
    {
        return "success";
    }
    else
    {
        return "＊ID、もしくはパスワードが間違っています。<br>もう一度入力してください。";
    }
}
?>
