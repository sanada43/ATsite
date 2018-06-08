<?php
	require("common.php");
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="./jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />  
</head>
<body>
<p>登録画面</p>

<form method="post" action="action.php">
<p>社員番号</p>
<input type="text" name="user_number" size=20>
<p>社員証ＩＤ</p>
<input type="text" name="user_ID" size=20>
<p>パスワード</p>
<input type="text" name="user_pass" size=20>
<input type="submit" value="登録" id="regist" name="action"/>
<input type="submit" value="変更" id="change" name="action"/>
<input type="submit" value="削除" id="delete" name="action"/>
</form>

<?php
echo $_POST["user_number"];
echo $_POST["user_ID"];
echo $_POST["user_pass"];
?>

</body>
</html>
