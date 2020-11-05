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
    <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="user_insert_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend>新規ユーザー登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>パスワード：<input type="password" name="lpw"></label><br>
     <label>ユーザータイプ：
      <input type="radio" name="kanri_flg" value=1 id="kanri"> 
      <label for="kanri">管理者</label>
      <input type="radio" name="kanri_flg" value=0 id="user" checked> 
      <label for="user">ユーザー</label>   
     </label>
     <input type="hidden" name="life_flg" value=0>
     <!-- <label>管理者の場合：<input type="checkbox" name="kanri_flag" value=1> </label><br> -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<!-- <footer>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_list.php">ユーザー一覧</a></div>
    </div>
  </nav>
</footer> -->
</body>
</html>
