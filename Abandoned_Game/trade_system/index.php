<?php
session_start();
$error_message = "";
if (isset($_POST['login']))
{
  if($_POST['user_name'] === "user" && $_POST['password'] === "password")
  {
    echo $_POST['user_name'];
    echo $_POST['password'];
    $error_message = "";
  }
  else {
  $error_message = "＊ID、もしくはパスワードが間違っています。<br>もう一度入力してください。";
  }
}
include("header.php");
if($error_message){
  echo $error_message;
}
?>
<body>
  <h1>メインページ</h1>
  <form action="index.php" method="POST">
    <p>ログインID：<input type="text" name="user_name"></p>
    <p>パスワード：<input type="text" name="password"></p>
    <input type="submit" name="login" value="ログイン">
  </form><br>
  <form action="register.php" method="POST">
    <input type="submit" name="register" value="新規登録はこちらから">
  </form>

<?php
  include("footer.php");
?>