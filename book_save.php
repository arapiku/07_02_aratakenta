<?php
// セッションをスタート
session_start();

// db情報
const DB = "127.0.0.1";
const DB_ID = "root";
const DB_PW = "";
const DB_NAME = "gs_db";

// サイナップボタンが押されたら
if (isset($_POST["book"])) {

    $book = htmlspecialchars($_POST["book"], ENT_QUOTES);
    // var_dump($book);
    $book_array = explode(",", $book);
    // var_dump($book_array[0]);    

    if (!empty($book)) {
        // セッションからユーザーIDを取得
        $uid = $_SESSION["ID"];
        var_dump($uid);

        // PDOでDB接続
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB, DB_NAME);
        try { 
            $pdo = new PDO($dsn, DB_ID, DB_PW, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
            // ステートメントを用意
            $pre_query = 'INSERT INTO post_data(id, uid, title, author, image) VALUES(NULL, :uid, :title, :author, :image)';
            $stmt = $pdo->prepare($pre_query);
            // バインドする
            $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
            $stmt->bindValue(':title', $book_array[0], PDO::PARAM_STR);
            $stmt->bindValue(':author', $book_array[1], PDO::PARAM_STR);
            $stmt->bindValue(':image', $book_array[2], PDO::PARAM_STR);
            // ステートメントを実行
            $stmt->execute();
            // マイページに移動
            header('Location: mypage.php');

        } catch (PDOException $e) {
            $errorMessage = "DBエラー";
            var_dump($e->getMessage());
        }
    } else {
        $errorMessage = "ポストデータが空です。";
    }
}