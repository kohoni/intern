<?php
/* 入力フォームからパラメータを取得 */
$formList = array('mode', 'input_userid', 'input_password', 'input_name', 'input_email');

/* ポストデータを取得しパラメータと同名の変数に格納 */
foreach($formList as $value) {
  $$value = htmlspecialchars($_POST[$value]);
}

/* エラーメッセージの初期化 */
$error = array();

     if(empty($input_password) || empty($input_password2)) {
        
     array_push($error,"<br>パスワードが正しく入力されていません。");
        
} 

    /* 入力されたパスワードが半角英数記号のみかどうかをチェック */ 

 

    elseif (!preg_match( "/[\@-\~]/" , $input_password)) {


        array_push($error,"<br>パスワードは半角英数字及び記号のみ入力してください。");

}

    /* 入力されたパスワードの長さが6文字以上、16文字以下かどうかをチェック*/

      elseif(strlen($input_password) < 6 || strlen($input_password) > 16) {
            array_push($error,"パスワードは6文字以上16文字以内でお願いします。");
}

      elseif($input_password !== $input_password2) {
    
        array_push($error,"<br>入力されたパスワードが一致しません。");
}

/* データベース接続設定 */
//local server ver
$server = "localhost";
$user = "root";
$dbpassword = "1234";
$dbname = "member_database1";


$s=mysql_connect("$server","$user","$dbpassword") or die("接続に失敗しました。");
  mysql_select_db($dbname,$s) or die("データベースに接続できませんでした。");

//create table if you don't.
//mysql_query("CREATE TABLE member_list1(userid varchar(255), password varchar(255));");
/* ユーザーIDチェック */
$query = "select userid from member_list1 where userid = '$input_userid'"; 
$resultId = mysql_query($query);
	
if(mysql_num_rows($resultId) > 0 ) { //ユーザーIDが存在
  array_push($error,"このユーザーIDはすでに登録されています。");
}
	
if(count($error) == 0) {
  
  //登録するデーターにエラーがない場合、memberテーブルにデータを追加する。
  //トランザクション開始
  mysql_query("begin");
  
  $query = "insert into member_list1(userid, password) values('$input_userid','$input_password')";
  $result = mysql_query($query);
  
  if($result){  //登録完了	
    //トランザクション終わり
    mysql_query("commit");
  } else {	//データベースへの登録作業失敗
    //ロールバック
    mysql_query("rollback");	
    array_push($error, "データベースに登録できませんでした。");
  }
}
if(count($error) == 0) {	
?>
<table>
  <caption>データベース登録完了</caption>
  <tr>
    <td>登録ありがとうございます。</td>
  </tr>
</table>
<?php
/* エラー内容表示 */
} else {
?>
<table>
  <caption>データベース登録エラー</caption>
  <tr>
   Error：
  <td>
  <?php
  foreach($error as $value) {
    print $value;
  ?>
  </td>
  </tr>
</table>
<?php
  }
}
?>