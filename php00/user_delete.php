<?php



// データ取得require_once("funcs.php");
$id = $_GET['id'];
include("funcs.php");
$pdo = db_conn();

//1. POSTデータ取得 detailからきる
//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE id= :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);      //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('user_list.php');
}
?>
