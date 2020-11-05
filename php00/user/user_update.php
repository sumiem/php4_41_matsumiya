<?php

require_once("funcs.php");

$name  = $_POST["name"];
$lid   = $_POST["lid"];
$lpw   = $_POST["lpw"];
$kanri_flag   = $_POST["kanri_flg"]; 
$life_flag    = $_POST["life_flg"]; 

$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE
                        gs_an_table 
                        SET 
                        name = :name,
                        email = :email,
                        age = :age,
                        naiyou = :naiyou,
                        indate = sysdate()
                    WHERE
                        id = :id ;");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', h($email), PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', h($age), PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', h($naiyou), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
    // $error = $stmt->errorInfo();
    // exit("SQLError:".$error[2]);
}else{
    //*** function化する！*****************
    redirect('index.php');
    // header("Location: index.php");
    // exit();
}
?>
