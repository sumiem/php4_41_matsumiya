<?php
require_once("funcs.php");
$id = $_GET['id'];
// var_dump($id);
$pdo = db_conn();
// まずはいちばんに上記を書く（関数を引き出すためにrequire)

//1. POSTデータ取得 detailからきる
//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM gs_bm_table WHERE id= :id');
$stmt->bindValue(':id', h($id), PDO::PARAM_INT);      //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('index.php');
}
?>
