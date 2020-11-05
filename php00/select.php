<?php
// 0. SESSION開始！！
session_start();
// 1. ログインチェック処理！

// 以下、セッションID持ってたら、ok 持ってなければ、閲覧できない処理にする
//login actに  !は打ち消し、issetもってるかと、違うSSIDで入ってないか ||はアンド

if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){
    exit('LOGIN Error');
    //ログインエラーになって表示変わらず
}else{
    //ログインOK
    //SES IDを新しくしてあげる
    session_regenerate_id(true);
    $_SESSION['chk_ssid']= session_id();
};

//１．関数群の読み込み  require_onceとの違いについて後で調べる
include("funcs.php");

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        // bn_update_view
        $view .= '<table>';
        $view .= '<tr>';
        $view .= '<td>';
        $view .= '<a href="bm_update_view.php?id=' . $result["id"] . '">'; 
        $view .= $result["name"] . '    /update:' . $result["indate"];
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる
        $view .= '</td>';
        $view .= '<td>';
        $view .= '<a href="delete.php?id=' . $result["id"] . '">'; 
        $view .= '  /[削除]';
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる
        $view .= '</td>';
        $view .= '<tr>';
        $view .= '</table>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>フリーアンケート表示</title>
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
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron"><?= $view ?></div>
    </div>
    <!-- Main[End] -->

    <!-- Head[Start] -->
    <footer>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div> -->
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
            </div>
        </nav>
    </footer>
    <!-- Head[End] -->
</body>

</html>
