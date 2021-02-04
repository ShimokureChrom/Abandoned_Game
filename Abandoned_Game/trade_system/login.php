<?php
include("header.php");
session_start();
$error_message = "";
$result = "";
if(!empty($_SESSION['logined']))
{
  if($_SESSION['logined'])
  {
    header("Location: home.php");
    exit;
  }
}
if (isset($_POST['login']))
{
  include("db_operate.php");
  $result = check_user($_POST['user_name'], $_POST['password']);
  $error_message = $result["error"];
  if($error_message === "success")
  {
    $_SESSION['logined'] = true;
    $_SESSION['user_name'] = $_POST['user_name'];
    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['money'] = $result['money'];
    $result = get_item($result['user_id'], 1);
    $error_message = $result["error"];
  }
  if($error_message === "success")
  {
    $_SESSION['item']['1'] = $result['count'];
    $error_message = "";
    header("Location: home.php") ;
    exit;
  }
  else
  {
    $_SESSION['logined'] = false;
  }
}
if($error_message){
  echo $error_message;
}
?>

  <h1>ログインページ</h1>
  <form action="login.php" method="POST">
    <p>名前　　　：<input type="text" name="user_name"></p>
    <p>パスワード：<input type="text" name="password"></p>
    <input type="submit" name="login" value="ログイン">
  </form><br>
  <form action="register.php" method="POST">
    <input type="submit" name="register" value="新規登録はこちらから">
  </form>

<?php
  include("footer.php");
?>
