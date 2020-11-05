<?php
// まずはいちばんに上記を書く（関数を引き出すためにrequire)
//1. POSTデータ取得 detailからきる
$name   = $_POST["name"];
$website  = $_POST["website"];
$comment = $_POST["comment"];
$id     = $_POST["id"]; 

require_once("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE
                        gs_bm_table 
                        SET 
                        name = :name,
                        website = :website,
                        comment = :comment,
                        indate = sysdate()
                    WHERE
                        id = :id ;");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);      //Integer（文字の場合 PDO::PARAM_STR)
$stmt->bindValue(':website', h($website), PDO::PARAM_STR);   
$stmt->bindValue(':comment', h($comment), PDO::PARAM_STR);      
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect('bm_list_view.php');
}
?>
