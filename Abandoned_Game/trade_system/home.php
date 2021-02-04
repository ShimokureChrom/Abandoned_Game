<?php
include("header.php");
include("auth.php");
session_start();
?>
<h1>ホーム画面</h1>
ユーザー名：<?php echo $_SESSION['user_name'] ?><br>
所持金　　：<?php echo $_SESSION['money'] ?><br>
所持大根　：<?php echo $_SESSION['item'][1] ?><br>
<form action="home.php" method="POST">
  <p>単価　　：<input type="number" name="price"></p>
  <p>販売個数：<input type="number" name="count"></p>
  <input type="submit" name="login" value="販売">
</form><br>
<?php
include("footer.php");
?>
