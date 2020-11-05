<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST['name'];
$website = $_POST['website'];
$comment = $_POST['comment'];

//接続して。かいて、じっこうして、しゅうりょうする
//2. DB接続します 接続処理
try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db_bm;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DB接続Error:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, name, website, comment, indate)VALUES(NULL, :name, :website, :comment, sysdate())");
$stmt->bindValue(':name', $name , PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':website', $website, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{ 
  header("Location:bm_index.php");  //かきこみが成功したら
  //５．index.phpへリダイレクト


}
?>
