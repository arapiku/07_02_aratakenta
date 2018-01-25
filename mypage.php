<?php
include_once "templates/header.php";
include_once "templates/footer.php";

// uidと一致する本データを抜き出してリスト表示
// require 'password.php';
// セッションをスタート
session_start();

// db情報
const DB = "127.0.0.1";
const DB_ID = "root";
const DB_PW = "";
const DB_NAME = "gs_db";

$sid = $_SESSION["ID"];
// PDOでDB接続
$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB, DB_NAME);
try { 
    $pdo = new PDO($dsn, DB_ID, DB_PW, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    // ステートメントを用意
    $pre_query = 'SELECT * FROM post_data WHERE uid ='.$sid;
    $stmt = $pdo->prepare($pre_query);
    // ステートメントを実行
    $stmt->execute();
    // 抽出が成功した時の処理
    print '<ul class="book_list">';
    foreach($stmt->fetchAll() as $row) { 
        // $id = $row['id'];
        $title = $row['title'];
        $author = $row['author'];
        $image = $row['image'];

        print '<li>';
        print '<img src="'.$image.'"><br>';
        print $title.'<br>';
        print $author;
        print '</li>';
    }
    print '</ul>';

} catch (PDOException $e) {
    $errorMessage = "DBエラー";
    var_dump($e->getMessage());
}

?>