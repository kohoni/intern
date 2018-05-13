<?php
//動画の名前を決める
session_start();
?>
<!DOCTYPE html>

<head>
<meta charset="utf-8">
	<title>動画格納</title>
</head>
<body>
<?php

$handle=htmlspecialchars($_POST["handle"]);

if (isset($_SESSION["loginUser"])or(!isset($_COOKIE["logincookie"]))!=null) {

	$file = $_FILES['upfile'];

	if ($handle <> "" and $file['size']>0
		and ($file['type'] == 'video/mp4')
		and(strtolower(mb_strrchr($file['name'], '.', FALSE)) == ".mp4")){
		
		if ($file['size'] > 2*1024*1024) {
			unlink($file['tmp_name']);
?>
<p>under 1MB</p>
<p><A HREF="index.php">go back to the writing page.</A></p>

<?php
		}else{


			$upDir = "movie";
            $fn = $file['name'];
			move_uploaded_file($file['tmp_name'],'movie/'.$fn);
			print "<p>" . $fn . "<BR>
			      <video src='$upDir/$fn'></video></p>" ;
			     
			/*local server ver*/
			$server = "localhost";
			$user = "root";
			$dbpassword = "1234";
			$dbname = "internship_cocospace";

			$s=mysql_connect("$server","$user","$dbpassword") or die("失敗しました");
			mysql_select_db($dbname,$s) or die("データベースに接続できませんでした。");
			mysql_query("INSERT INTO moviebbs(handle,movie,time) values('$handle','$fn',now());");
			mysql_close($s);      

		}
	}else{
?>
<p>名前を入力し、mp4ファイルを選択してください。<BR>
<a href="index.php"></a></p>
<?php
        }
}else{
header("Location:http://localhost/login.php");	
}
?>
</body>
</html>
