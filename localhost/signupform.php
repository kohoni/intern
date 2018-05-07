<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
	<title>会員登録</title>
</head>
<body>
	<form action="process.php" method="post">
	  <input type="hidden" name="mode" value="user_regist">
  	<table>
    	<caption>会員情報登録フォーム</caption>
    		<tr>
      			<td class="item">名前：</td>
      			<td><input type="text" size="30" name="input_userid"></td>
    		</tr>
    		<tr>
      			<td class="item">パスワード：</td>
      			<td><input type="password" size="30" name="input_password">&nbsp;&nbsp;※ 6文字以上16文字以下</td>
    		</tr>
    		<tr>
      			<td class="item">パスワード確認：</td>
      			<td><input type="password" size="30" name="input_password2">&nbsp;&nbsp;※ 6文字以上16文字以下</td>
    		</tr>
        <tr>
            <td class="item">メールアドレス</td>
            <td><input type="text" name="email" size="40" /> </td>
        </tr>
    </table>
    <div><input type="submit" name="submit" value="送信" /></div>
    </form>
</body>
</html>