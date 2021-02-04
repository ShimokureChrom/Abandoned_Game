<?php
include("auth.php");
include("header.php");
session_start();
$error_message = "";
if (isset($_POST['stock']))
{
  include("db_operate.php");
  $error_message = set_item($_SESSION['user_id'], 1, $_SESSION['item']['1']-$_POST['count']);
  if($error_message === "success")
  {
    $_SESSION['item']['1'] = $_SESSION['item']['1']-$_POST['count'];
    $error_message = insert_trade($_SESSION['user_id'], 1, $_POST['price'], $_POST['count']);
  }
  if($error_message === "success")
  {
    $error_message = "";
    header("Location: home.php") ;
    exit;
  }
}
if($error_message){
  echo $error_message;
}
?>
<br>
<form action='home.php' method='POST'>
<input type='submit' value='戻る'>
</form>
<?php
include("footer.php");
?>