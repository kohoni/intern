<?php
//会員データベース管理画面
/* データベース接続設定 */
/*local server ver*/
$server = "localhost";
$user = "root";
$dbpassword = "1234";
$dbname = "member_database1";


$s=mysql_connect("$server","$user","$dbpassword") or die("接続に失敗しました。");
  mysql_select_db($dbname,$s) or die("データベースに接続できませんでした。");
$re=mysql_query("SELECT * FROM member_list1;");
    while($kekka=mysql_fetch_array($re)) {
            print "ID";
            print ":";
            print $kekka[0];
            print "<BR>";

            
    }
    //echo mysql_errno($s) . ": " . mysql_error($s) . "\n" ;
    mysql_close($s);
?>
