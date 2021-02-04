<?php
include("auth.php");
include("header.php");
session_start();
$error_message = "";
if (isset($_POST['buy']))
{
  include("db_operate.php");
  $error_message = set_money($_SESSION['user_id'], $_SESSION['money'] - $_POST['cost']);
  if($error_message === "success")
  {  
    $error_message = set_item($_SESSION['user_id'], $_POST['item_id'], $_SESSION['item'][$_POST['item_id']] + $_POST['count']);
  }
  if($error_message === "success")
  {
    $_SESSION['item'][$_POST['item_id']] = $_SESSION['item'][$_POST['item_id']] + $_POST['count'];
    $result = delete_trade($_POST['trade_id']);
    $error_message = $result['error'];
    $user = (int)$result['user_id'];
  }
  if($error_message === "success")
  {
    $result = get_money($user);
    $error_message = $result['error'];
  }
  if($error_message === "success")
  {
    $error_message = set_money($user, $result['money'] + $_POST['cost']);
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