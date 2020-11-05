<?php
// 0. SESSION開始！！
session_start();
// 1. ログインチェック処理！

// 以下、セッションID持ってたら、ok 持ってなければ、閲覧できない処理にする
//login actに  !は打ち消し、issetもってるかと、違うSSIDで入ってないか ||はアンド

if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id() || $_SESSION['kanri_flg'] != 1){
    exit('ログインエラー管理者専用ページです。');
    //ログインエラーになって表示変わらず
}else{
    //ログインOK
    //SES IDを新しくしてあげる
    session_regenerate_id(true);
    $_SESSION['chk_ssid']= session_id();
};


$id = $_GET['id'];
//【重要】
// require_once("funcs.php");
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
//whereで条件文にする
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=" . $id);
$status = $stmt->execute();
//uうえのSQLを実行して、もんだいなければ下をじっこうする

//３．データ表示　fetch(PDO::FETCH_ASSOC)だと全件表示なので、ひとつにする
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
?>
<!-- {    while ($result = $stmt->fetch()) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $result["id"] . '">'; 
        //?をつけることで、getでやるみたいにできる id=でその先のデータが取得できる
        $view .= $result["indate"] . "：" . $result["name"];
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる
        $view .= '</p>';
    }
} -->


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー情報</title>
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
                    <a class="navbar-brand" href="./index.php">データ登録</a>
                    <a class="navbar-brand" href="user_delete.php">ユーザーデータ削除</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- <div>
        <div class="container jumbotron">
            <a href="detail.php"></a>
            <?= $view ?>
        </div>
    </div> -->
    <!-- Main[End] -->
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!-- insertではなくてupdateにおくる -->

<form method="POST" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー情報・変更</legend>
     <label>名前：<input type="text" name="name" value=<?= $result['name'] ?>></label><br>
     <label>ID：<input type="text" name="lid" value=<?= $result['lid'] ?>></label><br>
     <label>パスワード：<input type="text" name="lpw" value=<?= $result['name'] ?>></label><br>
     <input type="hidden" name="id" value=<?= $result['id'] ?>>
     <input type="submit" value="変更">
    </fieldset>
  </div>
</form>

