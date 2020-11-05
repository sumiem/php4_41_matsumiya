<?php
// 0. SESSION開始！！
session_start();
// require_once("funcs.php");
include("funcs.php");
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();


//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        $view .= '<a href="user_detail.php?id=' . $result["id"] . '">'; 
        //?をつけることで、getでやるみたいにできる id=でその先のデータが取得できる
        $view .= $result["lid"] . "：" . $result["name"];
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる

        $view .= '<a href="delete.php?id=' . $result["id"] . '">'; 
        $view .= '  /[削除]';
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる

        $view .= '</p>';
    }
}
//３．データ表示 これだけだとsessionがログアウトしてもまだ表示されてしまう。なのでセッションチェックする
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
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
        <div class="container jumbotron">
            <a href="detail.php"></a>
            <?= $view ?>
        </div>
    </div>
    <!-- Main[End] -->

</body>

</html>
