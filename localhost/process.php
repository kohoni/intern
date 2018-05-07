<?php
/* 登録処理（終了を知らせる値）によって読み込むファイルを変える */
$mode = htmlspecialchars($_POST["mode"]);

/* 振り分け処理 */
switch($mode) {

  //登録
  case"registed":
  $module = "registed.php";
  break;
	
  //仮会員登録
  case"user_regist":
  $module = "user_regist.php";
  break;
	
  //メールアドレス登録（初期画面）
  default:
  $module = "signupform.php";
  break;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>会員登録フォーム</title>
</head>
<body>
<?php
  // コンテンツ（表示ページ）読み込み
  require_once($module);
?>
</body>
</html>