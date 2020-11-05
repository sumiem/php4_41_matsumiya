<?php

session_start();

// まずはデータを準備（全部ここから）
// require_once("funcs.php");
$id = $_GET['id'];
include("funcs.php");
$pdo = db_conn();
//１．selectのリンク先を用意してデータを取る

// var_dump($id); //確認用

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=" . $id);
$status = $stmt->execute();
//３．データ表示 一つとりだす
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}

//３．データ表示 これだけだとsessionがログアウトしてもまだ表示されてしまう。なのでセッションチェックする
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>
<!-- html記述 -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録書籍</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="bm_list_view.php">書籍リストへ</a>
                <a class="navbar-brand" href="bm_index.php"> 新規登録</a>

                </div>
            </div>
        </nav>
    </header>

<!-- insertではなくてupdateにおくる -->
<form method="POST" action="bm_update.php">
  <div class="jumbotron">

  <div class="jumbotron">
   <fieldset>
    <legend>書籍情報</legend>
     <label>書籍名：<input type="text" name="name" value=<?= $result['name'] ?>></label><br>
     <label>URL：<input type="text" name="website" value=<?= $result['website'] ?>></label><br>
     <label>感想:<textArea name="comment" rows="4" cols="40"><?= $result['comment'] ?></textArea></label><br>
     <input type="hidden" name="id" value=<?= $result['id'] ?>>
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
  </div>
</form>
