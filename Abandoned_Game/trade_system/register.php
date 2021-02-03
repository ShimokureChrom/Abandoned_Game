<?php
include("header.php");
session_start();
$error_message = "";
if (isset($_POST['login']))
{
  include("db_operate.php");
  $error_message = insert_user($_POST['user_name'], $_POST['password']);
  if($error_message === "success")
  {
    $_SESSION['logined'] = true;
    $_SESSION['user_name'] = $_POST['user_name'];
    $_SESSION['user_id'] = $result;
    $error_message = "";
    header("Location: home.php") ;
    exit;
  }
}
if($error_message){
  echo $error_message;
}
?>

<h1>新規登録ページ</h1>
<form action="register.php" method="POST">
  <p>名前　　　：<input type="text" name="user_name"></p>
  <p>パスワード：<input type="text" name="password"></p>
  <input type="submit" name="login" value="登録">
</form>

<?php
  include("footer.php");
?>