<?
/*local server ver*/
$server = "localhost";
$user = "root";
$dbpassword = "1234";
$dbname = "internship_cocospace";

$s=mysql_connect("$server","$user","$dbpassword") or die("失敗しました");
mysql_select_db($dbname,$s) or die("データベースに接続できませんでした。");
?>