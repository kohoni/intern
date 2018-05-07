<?php
/*pre_useridの値を取得*/
if($mode == "registed") {
  $pre_userid = $_GET['pre_userid'];
}

/* pre_userid 有効チェック */
$errorFlag = true;

/* データベース接続設定 */
/*local server ver*/
$server = "localhost";
$user = "root";
$dbpassword = "1234";
$dbname = "member_database1";


/* 取得したユニークIDをキーに登録されたメールアドレスを取得 */
$query = "select email from member_list1 where pre_userid = '$pre_userid'";
$result = mysql_query($query);

/*データベースより取得したメールアドレスを表示*/
if(mysql_num_rows($result) > 0) { //取得した結果のデータの数が0以上なら → データが取得できた
  //データが正常に取得できた
  $errorFlag = false;
  $data = mysql_fetch_array($result); 
  $email = $data['email'];
}

if($errorFlag) {  // pre_useridが無効
?>
<table>
  <caption>メールアドレス登録エラー</caption>
  <tr>
    <td class="item">Error：</td>
    <td>このURLは利用できません。<br>もう一度メールアドレスの登録からお願いします。<br> <a href="index.php">会員登録ページ</a></td>
  </tr>
</table>
<?php
} else { // pre_useridが有効
	// regist_confirmでのエラー表示
  if(count($error) > 0) {
    foreach($error as $value) {
	  print $value."<br>";
    }
  }
?>