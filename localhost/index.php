<?php
//ログインしているかの検査
//ホーム画面
session_start();

if(!isset($_SESSION["loginUser"])or(!isset($_COOKIE["logincookie"]))){

/*localhost ver*/
//$nologin="http://localhost/localhost/login.php"*/
    header("Location:http://localhost/localhost/login.php");
exit;  
}else{
  print "write anything";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
	<title>入力フォーム</title>
  <script type="text/javascript">
  <!--
  
  function check(){
          var flag = 0;

          if (document.form1.handle.value === "") {
              flag = 1;
          }
          else if (document.form1.comment.value === "") {
              flag = 1;
          }

          if (flag) {
              window.alert('未入力です');
              return false;
          }
          else{
                return true;
          }
  }  
  
// -->
  </script>
</head>
<body> 
  <form action="index_insert.php" method="post" name="form1" onsubmit="return check()">
  <p>名前:<input type="text" name="handle" value="<?php print $_COOKIE['logincookie'];?>"></p>
  <p>コメント:</p>
  <textarea name="comment" cols="30" rows="5"></textarea>
  <p><input type="submit" value="送信" ></p>
</form>
  <p>ファイルをアップロード(画像）（jpgファイルをアップロードしてください）:</p>
  <form action="upload.php" method="POST" enctype="multipart/form-data">
        <p>名前:<input type="text" name="handle" value="<?php print $_COOKIE['logincookie'];?>"></p>
        <p><input type="file" name="upfile">
        <input type="submit" name="submit" value="ファイルをアップロードする"></p>
  </form>
   <p>ファイルをアップロード(動画）（mp4ファイルをアップロードしてください）:</p>
  <form action="uploadvideo.php" method="POST" enctype="multipart/form-data">
        <p>名前:<input type="text" name="handle" value="<?php print $_COOKIE['logincookie'];?>"></p>
        <p><input type="file" name="upfile">
        <input type="submit" name="submit" value="ファイルをアップロードする"></p>
  </form>  
    <p>
    コメント一覧表:
    <?php
    /*local server ver*/
    $server = "localhost";
    $user = "root";
    $dbpassword = "1234";
    $dbname = "internship_cocospace";

    //passwordは仮です。

    $s=mysql_connect("$server","$user","$dbpassword") or die("失敗しました");
    mysql_select_db($dbname,$s) or die("データベースに接続できませんでした。");

    echo mysql_errno($s) . ": " . mysql_error($s) . "\n" ;
    mysql_query("ALTER TABLE bbs1 auto_increment=0;");
    mysql_query("SELECT * FROM bbs1 where handle NOT LIKE '' ;");
    mysql_query("SELECT * FROM bbs1 where comment NOT LIKE '' ;");
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
    ?>
    </p>
    <BR>
    <p>
    画像一覧:
    <?php
    $upDir = "gz_img";
    //echo mysql_errno($s) . ": " . mysql_error($s) . "\n" ;
    mysql_query("ALTER TABLE imgbbs1 auto_increment=0;");
    $res=mysql_query("select * from imgbbs1 order by number");
    while ($result=mysql_fetch_array($res)) {
            print " { ";
            print $result[0];
            print " } ";
            print " { ";
            print $result[1];
            print " } ";
            print " { ";
            print $result[3];
            print " } ";
            print "<BR><IMG SRC='$upDir/thumb_";
            print $result[2];
            print "'></A><HR>";
    }
    //echo mysql_errno($s) . ": " . mysql_error($s) . "\n" ;
    ?>
    </p>
    <p>
    動画一覧:
    <?php
    $upDir1 = "movie";
    //echo mysql_errno($s) . ": " . mysql_error($s) . "\n" ;
    mysql_query("ALTER TABLE moviebbs auto_increment=0;");
    $rest=mysql_query("select * from moviebbs order by number");
    while ($results=mysql_fetch_array($rest)) {
            print " { ";
            print $results[0];
            print " } ";
            print " { ";
            print $results[1];
            print " } ";
            print " { ";
            print $results[3];
            print " } ";
            print "<BR><VIDEO SRC='$upDir1/";
            print $results[2];
            print "'></VIDEO></A><HR>";
    }
    mysql_close($s);
    ?>
    </p>

  管理人はパスワードを入力してください。
  <form action="delete.php" method="POST" onclick="passWd(this.form.pass1.value)">
      <input name="pass1" type="password">
<input type="submit" value="削除フォームへログイン">
</form>
<form action="edit.php" method="POST" onclick="passWd2(this.form.pass2.value)">
    <input name="pass2" type="password">
<input type="submit" value="編集フォームへログイン">
</form>
</body>
</html>
