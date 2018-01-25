<?php
include_once "templates/header.php";
include_once "templates/footer.php";

// セッションをスタート
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: logout.php");
    exit();
}

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

include_once "templates/header.php";
?>
<p>ようこそ<u><?= h($_SESSION["NAME"]); ?></u>さん</p>
<ul>
    <li id="search_btn"><a href="search.php">本を登録</a></li>
</ul>