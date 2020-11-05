<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title> ログイン</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_list.php">ログイン</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="user_list.php">ユーザー一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>新規ユーザー登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>パスワード：<input type="text" name="lpw"></label><br>
     <label>管理者の場合 選択：<input type="button" name="kanri_flag"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
