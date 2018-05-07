<?php
session_start();

$handle=htmlspecialchars($_POST["handle"]);

if (isset($_SESSION["loginUser"])or(!isset($_COOKIE["logincookie"]))!=null) 
{

	$file = $_FILES['upfile'];

	if ($handle <> "" and $file['size']>0
		and ($file['type'] == 'image/jpeg' ||
			 $file['type'] == 'image/pjpeg')
		and(strtolower(mb_strrchr($file['name'], '.', FALSE)) == ".jpg")) 
	{
		
		if ($file['size'] > 1024*1024) 
		{
			unlink($file['tmp_name']);
		}
		else
		{
			header("Location:http://localhost/localhost/upload.php");
		}
	}
	elseif
		($handle <> "" and $file['size']>0
		and ($file['type'] == 'video/mp4' )
		and(strtolower(mb_strrchr($file['name'], '.', FALSE)) == ".mp4")) 
	{
		if ($file['size'] > 1024*1024) 
		{
			unlink($file['tmp_name']);
		}
		else
		{
			header("Location:http://localhost/localhost/uploadvideo.php");
	    }
    }
	else
	{
	?>

		<a href="http://localhost/localhost/index.php">jpegファイルまたはmp4ファイルをアップロードしてください</a>;
    <?php		
	}
}
?>