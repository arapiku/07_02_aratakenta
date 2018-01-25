<?php
include_once "templates/header.php";
include_once "templates/footer.php";
// セッションをスタート
session_start();

// ログアウト判定
if (isset($_SESSION["NAME"])) {
    $errorMessage = "ログアウトしました。";
} else { 
    $errorMessage = "セッションがタイムアウトしました";
}

// セッションクリア
// セッション変数を空に
$_SESSION = [];
// セッションクッキーが存在する場合には破棄
if (isset($_COOKIE[session_name()])) {
    $cparam = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600,
    $cparam['path'], $cparam['domain'],
    $cparam['secure'], $cparam['httponly']);
}
// セッションを破棄
session_destroy();

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
<h1>ログアウト画面</h1>
<div><?= h($errorMessage); ?></div>
<ul>
    <li><a href="login.php">ログイン画面に戻る</a></li>
</ul>