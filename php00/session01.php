<?php 
// まずは絶対これを忘れずに一番最初に持ってくる。動かないとき最初にチェック
session_start();
// ユニークなセッションIDがサーバー上に付与された形にする。
$id = session_id();
// １回表示してみよう
// echo $id;

//  好きな配列で好きな情報を_SESSION[]で好きなものをいれる 
$_SESSION['name'] = 'まっと';
$_SESSION['age'] = 37;
$_SESSION['country'] = 'おっととお';


print_r($_SESSION);
// 配列をVARDUMPの代わりに表示 <print_r></print_r>

// sessionは通常の変数をかくと、セッション内でしか、使えない変数となる、が。$_SESSIONにすることで、他でも使える変数となる
// ここまでだと、IDを自動生成してるが、これをサーバーとPCとの間で会話しているうちに、IDを盗むハイジャックはん＝