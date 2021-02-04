<?php
include("header.php");
include("auth.php");
session_start();
include("db_operate.php");
$result = get_money($_SESSION['user_id']);
$error_message = $result['error'];
if($error_message === "success")
{
  $_SESSION['money'] = $result['money'];
}
else
{
  echo $error_message;
}
?>
<h1>大根取引ホーム画面</h1>
ユーザー名：<?php echo $_SESSION['user_name'] ?><br>
所持金　　：<?php echo $_SESSION['money'] ?><br>
所持大根　：<?php echo $_SESSION['item'][1] ?><br>
<h2>大根販売</h2>
<form action="stock.php" method="POST">
  <p>大根単価：<input type="number" name="price" min=1 required></p>
  <p>販売個数：<input type="number" name="count" min=1 required></p>
  <input type="submit" name="stock" value="販売">
</form><br>
<h2>大根購入</h2>
<?php
$result = get_trades();
$error_message = $result["error"];
if($error_message === "success")
{
  foreach($result["trade"] as $trade)
  {
    if($trade["id"] === "NONE")
    {
      break;
    }
    echo "単価：".$trade["price"]."，個数：".$trade["count"]."，合計金額：".$trade["price"]*$trade["count"]."";
    echo "<form action='buy.php' method='POST'>
    <input type='hidden' name='trade_id' value=".$trade["id"].">
    <input type='hidden' name='item_id' value=".$trade["item_id"].">
    <input type='hidden' name='cost' value=".$trade["price"]*$trade["count"].">
    <input type='hidden' name='count' value=".$trade["count"].">
    <input type='submit' name='buy' value='購入'>
    </form><br>";
  }
}
else
{
  echo $error_message;
}
include("footer.php");
?>
