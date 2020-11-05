<?php
// 0. SESSION開始！！
session_start();

// 1. ログインチェック処理！

if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){
    exit('LOGIN Error');
    //ログインエラーになって表示変わらず
}else{
    //ログインOK
    //SES IDを新しくしてあげる
    session_regenerate_id(true);
    $_SESSION['chk_ssid']= session_id();
};

//【重要】データを取り出す 関数読み込み
include("funcs.php");
// require_once("funcs.php");
$pdo = db_conn();
//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        // $view .= '<p>';
        $view .= '<table>';
        $view .= '<tr>';
        $view .= '<td>';
        $view .= '<a href="bm_update_view.php?id=' . $result["id"] . '">'; 
        $view .= $result["name"] . '    /update:' . $result["indate"];
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる
        $view .= '</td>';
        $view .= '<td>';
        $view .= '<a href="bm_delete.php?id=' . $result["id"] . '">'; 
        $view .= '  /[削除]';
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる
        $view .= '</td>';
        $view .= '<tr>';
        $view .= '</table>';
    }
};

//３．データ表示 これだけだとsessionがログアウトしてもまだ表示されてしまう。なのでセッションチェックする
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>


<!-- //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $result["id"] . '">'; 
        //?をつけることで、getでやるみたいにできる id=でその先のデータが取得できる
        $view .= $result["indate"] . "：" . $result["name"];
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる

        $view .= '<a href="delete.php?id=' . $result["id"] . '">'; 
        $view .= '  /[削除]';
        $view .= '</a>';  //aタグはとじなきゃいけないので閉じる

        $view .= '</p>';
    } -->


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>書籍一覧</title>
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
                <h1>書籍一覧</h1>
                    <a class="navbar-brand" href="bm_index.php">新規登録</a>
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
    <footer>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div> -->
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
                <!-- リンクを張り直すこと -->
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ユーザー情報の変更</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="user_list.php">ユーザー管理</a></div>
            </div>
        </nav>
    </footer>
</body>

</html>

