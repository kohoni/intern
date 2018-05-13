<?php
//セッション作成
session_start();

if(!isset($_POST['login'])) {
  //ログインフォームを表示
  inputForm();
} else {

  //フォームの値を取得
  $formUserId = $_POST['formUserid'];
  $formPassword = sha1($_POST['formPassword']);
	
  //ID, PASWORDが未入力の場合
  if(($formUserId == "") || ($formPassword == "")) {
	
  //エラー関数の呼び出し
  error(1);
		
  } else { 
  //ID,PASSWORD 入力アリ	
  //データベースへ接続
/*local server ver*/
$server = "localhost";
$user = "root";
$dbpassword = "1234";
$dbname = "member_database1";


$s=mysql_connect("$server","$user","$dbpassword") or die("接続に失敗しました。");
  mysql_select_db($dbname,$s) or die("データベースに接続できませんでした。");

  //memberテーブルのデータを取得
  $query = "select * from member_list1";
  $result = mysql_query($query);
		
  //フォームから取得したUSERIDとデータベース内のUSERIDが一致したらデータベースのPASSWORDを変数に格納		
  while($data = mysql_fetch_array($result)) {
    if($data['userid'] == $formUserId) {  //フォームから取得したUSERIDとデータベースのUSERIDが一致
      $dbPassword = $data['password'];
      break;
    }
  }
	echo mysql_errno($s) . ": " . mysql_error($s) . "\n" ;
  //MySQLデータベースを閉じる
  mysql_close($s);
  
  //$dbPasswordという変数に値が格納されていない場合→formUserIdとデータベースのIDが不一致
  if(!isset($dbPassword)) {
    error(2);
  } else {
  //formUserIdとデータベースのIDが一致
  //フォームのパスワードとデータベース内のパスワードが不一致
    if($dbPassword != $formPassword){
	  error(3);
	} else {
	  //ID,パスワードどちらも一致
	  //セッション変数を作成→セッション変数に　$formUserID を登録
    setcookie('logincookie',$formUserId,time()+60*60*24);
	  $_SESSION['loginUser'] = $formUserId;
	  header("Location:http://localhost/localhost/index.php");
	  }
	}
  }
}
?>
<?php
  //入力画面表示画面	
  function inputForm() {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログイン</title>
</head>
<body>
  <h1>ログインページ</h1>
  <form action="login.php" method="post">
  <label for="userid">ユーザーID</label>：
  <input type="text" name="formUserid" id="userid"/>
  <br />
  <label for="password">パスワード</label>：
  <input type="password" name="formPassword" id="password"/>
  <br />
  <input type="submit" name="login" value="ログイン" />
</form>
</body>
</html>
<?php
}

//エラー表示関数
function error($errorType) {
  
  switch($errorType) {
    case 1:
    $errorMsg = "IDとパスワードを入力してください。";
    break;
    
    case 2:
    $errorMsg = "IDもしくはパスワードが違います";
    break;
    
    case 3:
    $errorMsg = "IDもしくはパスワードが違います";
    break;
}
?>	
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログイン</title>
</head>
<body>
<h1>エラーページ</h1>
<?php
  print $errorMsg;
?>
</body>
</html> 
<?php
}
?>
