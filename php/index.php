<?php
	require("common.php");
	try {
		$mysqli = create_connection();
		#require("prepare_info.php");
	} finally {
		$mysqli->close();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>クリックされたボタンに応じて処理を分岐する</title>
</head>
<body>
<?php
if (isset($_POST["sub1"])) {
    $kbn = htmlspecialchars($_POST["sub1"], ENT_QUOTES, "UTF-8");
    $user_number = $_POST["user_number"];
    $user_ID = $_POST["user_ID"];
    $user_pass = $_POST["user_pass"];
    switch ($kbn) {
        case "登録する":
            echo "登録処理";
            #echo $_POST["user_number"];
            #echo $_POST["user_ID"];
            #echo $_POST["user_pass"];
            $VALUE[$user_ID]    = array("name" => $user_number,"LoginID" => $user_number, "PassWord" => $user_pass);
            $json = json_encode($VALUE);
            #echo $json;
            try {
                $mysqli = create_connection();

                // 重複チェック
                $stmt = $mysqli->prepare('SELECT id FROM card_master WHERE number = ? AND cardnum = ?');
                if ($stmt) {
                    $stmt->bind_param("ss",$user_number, $user_ID);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->fetch()) {
                        echo "重複する登録があります。";
                    }
                    $stmt->close();
                } else {
                    echo "登録に失敗しました。1";
                }

                // 登録
                $stmt = $mysqli->prepare('INSERT INTO card_master (cardnum, number, login, passwd) VALUES (?, ?, ?, ? )');
                if ($stmt) {
                    $stmt->bind_param("ssss",$user_ID, $user_number, $user_number, $user_pass);
                    $stmt->execute();
                    if ($stmt->affected_rows != 1) {
                        echo "登録に失敗しました。2";
                        echo mysqli_stmt_error($stmt);

                    }
                    $stmt->close();
                } else {
                    echo "登録に失敗しました。3";
                }
            } finally {
                $mysqli->close();
            }
            break;
        case "変更する":
            echo "変更処理";
            echo $_POST["user_number"];
            echo $_POST["user_ID"];
            echo $_POST["user_pass"];
            try {
                $mysqli = create_connection();

                // 重複チェック
                $stmt = $mysqli->prepare('SELECT id FROM card_master WHERE number = ? AND cardnum = ?');
                if ($stmt) {
                    $stmt->bind_param("ss",$user_number, $user_ID);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->fetch()) {
                        
                    }else{
                        echo "見つかりませんでした。";
                        break;
                    }
                    $stmt->close();
                } else {
                    echo "登録に失敗しました。1";
                }

                // 登録
                $stmt = $mysqli->prepare('REPLACE INTO card_master (cardnum, number, login, passwd) VALUES (?, ?, ?, ? )');
                if ($stmt) {
                    $stmt->bind_param("ssss",$user_ID, $user_number, $user_number, $user_pass);
                    $stmt->execute();
                    if ($stmt->affected_rows != 1) {
                        echo "登録に失敗しました。2";
                        #echo mysqli_stmt_error($stmt);

                    }
                    $stmt->close();
                } else {
                    echo "登録に失敗しました。3";
                }
            } finally {
                $mysqli->close();
            }
            break;
        case "削除する":
            echo "削除処理";
            echo $_POST["user_number"];
            echo $_POST["user_ID"];
            echo $_POST["user_pass"];
            try {
                $mysqli = create_connection();

                // 重複チェック
                $stmt = $mysqli->prepare('SELECT id FROM card_master WHERE number = ? AND cardnum = ?');
                if ($stmt) {
                    $stmt->bind_param("ss",$user_number, $user_ID);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->fetch()) {
                        
                    }else{
                        echo "見つかりませんでした。";
                        break;
                    }
                    $stmt->close();
                } else {
                    echo "登録に失敗しました。1";
                }

                // 登録
                $stmt = $mysqli->prepare('DELETE FROM card_master WHERE number = ? AND cardnum = ?');
                if ($stmt) {
                    $stmt->bind_param("ss",$user_number, $user_ID);
                    $stmt->execute();
                    if ($stmt->affected_rows != 1) {
                        echo "登録に失敗しました。2";
                        #echo mysqli_stmt_error($stmt);

                    }
                    $stmt->close();
                } else {
                    echo "登録に失敗しました。3";
                }
            } finally {
                $mysqli->close();
            }
            break;
            break;
        default:
        echo "エラー";
        exit;
    }
}
?>
<form method="POST" action="">
<p>社員番号</p>
<input type="text" name="user_number" size=20>
<p>社員証ＩＤ</p>
<input type="text" name="user_ID" size=20>
<p>パスワード</p>
<input type="text" name="user_pass" size=20>
<p></p>
<input type="submit" value="登録する" name="sub1">　
<input type="submit" value="変更する" name="sub1">　
<input type="submit" value="削除する" name="sub1">　
</form>
</body>
</html>



