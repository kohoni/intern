<?php
session_start();
?>
<!DOCTYPE html>

<head>
<meta charset="utf-8">
	<title>画像格納</title>
</head>
<body>
<?php

$handle=htmlspecialchars($_POST["handle"]);

if (isset($_SESSION["loginUser"])or(!isset($_COOKIE["logincookie"]))!=null) {

	$file = $_FILES['upfile'];

	if ($handle <> "" and $file['size']>0
		and ($file['type'] == 'image/jpeg' ||
			 $file['type'] == 'image/pjpeg')
		and(strtolower(mb_strrchr($file['name'], '.', FALSE)) == ".jpg")) {
		
		if ($file['size'] > 1024*1024) {
			unlink($file['tmp_name']);
?>
<p>under 1MB</p>
<p><A HREF="index.php">go back to the writing page.</A></p>

<?php
		}else{


			$upDir = "gz_img";
            $fn = $file['name'];
            $str = mb_convert_encoding($fn, "utf-8","AUTO");
			move_uploaded_file($file['tmp_name'],'gz_img/'.$str);




			$sourceimg = imagecreatefromjpeg("$upDir/$str");
			list($w , $h) = getimagesize("$upDir/$str");
			$new_h = 200;
			$new_w= $w*200/$h;
			$mythumb = imagecreatetruecolor($new_w, $new_h);
			imagecopyresized($mythumb, $sourceimg, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
			imagejpeg($mythumb,"$upDir/thumb_$str");

			print "<p>" . $fn . "<BR>
			      <IMG SRC='$upDir/thumb_$fn'></p>" ;
			     
			/*local server ver*/
			$server = "localhost";
			$user = "root";
			$dbpassword = "1234";
			$dbname = "internship_cocospace";

			$s=mysql_connect("$server","$user","$dbpassword") or die("失敗しました");
			mysql_select_db($dbname,$s) or die("データベースに接続できませんでした。");
			mysql_query("INSERT INTO imgbbs1(handle,img,time) values('$handle','$fn',now());");
			mysql_close($s);      

		}
	}else{
?>
<p>名前を入力し、jpegファイルを選択してください。<BR>
<a href="index.php"></a></p>
<?php
    }
}else{
header("Location:http://localhost/localhost/login.php");	
}
?>
</body>
</html>