<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>中途之家註冊</title>
	<style>
        a {
            cursor: pointer;
            color: #44f;
        }
    </style>
</head>
<body>
<?php
try {
	require_once("connectBD103G2.php");

	$name = $_POST['userName'];
	$id = $_POST['userId'];
	$psw = $_POST['userPsw'];
	$tel = $_POST['userTel'];
	$head = $_POST['userHead'];
	$address = $_POST['userAddress'];

	$sql = "select * from halfway_member where half_Id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(1, $id);
	$stmt->execute();
	if ($stmt->rowCount() != 0) {
		echo "<center>帳號已存在！</center>";
		return;
	} else {
		if (!isset($_FILES['image'])) {
			echo "<center>請上傳大頭貼!</center>";
		} else if (($_FILES['image']['type'] == "image/gif" || $_FILES['image']['type'] == "image/png" || $_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/JPEG" || $_FILES['image']['type'] == "image/PNG" || $_FILES['image']['type'] == "image/GIF")) {
			if ($_FILES['image']['error'] === 0) {
				$dir = "../images/halfMemberPic";
				if (file_exists($dir) === false) {    // 如果沒有$dir資料夾路徑
					mkdir($dir);    // 創建一個資料夾 路徑與名字=$dir
				}
				$fileType = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.'));
				$source = $_FILES['image']['tmp_name'];
				$dest = $dir . "/$id" . $fileType;
				if (move_uploaded_file($source, $dest)) {
					if ($name != null && $id != null && $psw != null && $tel != null && $head != null && $address != null && $dest != null) {
						$sql = "insert into HALFWAY_MEMBER set HALF_Name = ?,
									HALF_ID = ?,
									HALF_PSW = ?,
									HALF_TEL = ?,
									HALF_HEAD = ?,
									HALF_ADDRESS = ?,
									HALF_COVER = ?";
						$stmt = $pdo->prepare($sql);
						$stmt->bindValue(1, $name);
						$stmt->bindValue(2, $id);
						$stmt->bindValue(3, MD5($psw));
						$stmt->bindValue(4, $tel);
						$stmt->bindValue(5, $head);
						$stmt->bindValue(6, $address);
						$stmt->bindValue(7, $dest);
						$stmt->execute();
						echo "<center>註冊成功<br>請靜候審核</center><br>";
					} else {
						echo "<center>您的資料輸入未完全, 請檢查</center>";
					}
				} else {
					echo "<center>上傳圖片至伺服器失敗</center>";
				}
			} elseif ($_FILES['image']['error'] === 1) {
				echo "<center>上傳檔案太大, 不可超過", ini_get("upload_max_filesize"), "</center>";
			} elseif ($_FILES['image']['error'] === 2) {
				echo "<center>上傳檔案太大, 不可超過", $_POST['MAX_FILE_SIZE'], "Byte(1024kb)</center>";
			} elseif ($_FILES['image']['error'] === 3) {
				echo "<center>上傳檔案不完整, 請檢查您的網路狀態</center>";
			} elseif ($_FILES['image']['error'] === 4) {
				echo "<center>未指定上傳檔案, 請重新確認</center>";
			} else {
				echo "<center>上傳圖片失敗</center>";
			}
		} else {
			echo "<center>檔案格式錯誤須為jpg/gif/png/jpeg</center>";
		}
	}
} catch (Exception $e) {
	echo "<center>因為小精靈在搗亂伺服器所以失敗了唷<br>請稍後再試</center>";
}
echo "<center>將在五秒後回到原網址</center><br><center><a id='backNext'>或點此直接回到原網址</a></center>";

?>
<script>
    window.addEventListener('load', () => {
    let back = document.getElementById('backNext')
    setTimeout(function(){
        window.history.back()
    }, 5000)
    back.addEventListener('click', (e) => {
        e.preventDefault();
        window.history.back()
    })
})
</script>
</body>
</html>