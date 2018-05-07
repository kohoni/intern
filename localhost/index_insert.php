<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
	<title>入力しました</title>
</head>
<body>
<?php
	$handle=htmlspecialchars($_POST["handle"]);
	$comment=htmlspecialchars($_POST["comment"]);
    /*local server ver*/
    $server = "localhost";
    $user = "root";
    $dbpassword = "1234";
    $dbname = "internship_cocospace";

	$s=mysql_connect("$server","$user","$dbpassword") or die("失敗しました");
	print"入力しました<BR>";
	mysql_select_db($dbname,$s) or die("データベースに接続できませんでした。");
    mysql_query("CREATE TABLE bbs1(number INT(100) AUTO_INCREMENT PRIMARY KEY,handle varchar(100),comment varchar(200),time datetime);");
	mysql_query("INSERT INTO bbs1 (handle,comment,time) Value('$handle','$comment',now())");
	//echo mysql_errno($s) . ": " . mysql_error($s) . "\n" ;
	mysql_query("ALTER TABLE bbs1 auto_increment=0;");
    mysql_query("SELECT * FROM bbs1 where handle NOT LIKE '' ;");
	$re=mysql_query("SELECT * FROM bbs1 order by number;");
    while($kekka=mysql_fetch_array($re)) {
            print " { ";
            print $kekka[0];
            print " } ";
            print " { ";
            print $kekka[1];
            print " } ";
            print " { ";
            print $kekka[2];
            print " } ";
            print " { ";
            print $kekka[3];
            print " } ";
            print "<BR>";
    }
mysql_close($s);
print "<BR><a href='index.php'>go back to the top page.</a>";
?>
</body>
</html>