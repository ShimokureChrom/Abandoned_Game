<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="js/vue.js"></script>
  <title>大根取引市場</title>
</head>
<body>
<?php
session_start();
if(empty($_SESSION['logined']))
{
    $_SESSION['logined'] = false;
}
if($_SESSION['logined'])
{
  echo $_SESSION['user_name'];
  echo "<form action='logout.php' method='POST'>
  <input type='submit' name='logout' value='ログアウト'>
</form>";
}
else
{
  echo "<form action='login.php' method='POST'>
  <input type='submit' value='ログイン'>
</form>";
}
session_write_close();

?>