
/*データベースの接続設定*/
$server = "localhost";
$user = "root";
$password = "1234";
$dbname = "member_database1";

/*データベースに接続*/
$conn = mysql_connect($server, $user, $password);
mysql_select_db($dbname);