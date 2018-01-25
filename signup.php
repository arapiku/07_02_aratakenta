<?php
include_once "templates/header.php";
include_once "templates/footer.php";
// セッションをスタート
session_start();

// db情報
const DB = "127.0.0.1";
const DB_ID = "root";
const DB_PW = "";
const DB_NAME = "gs_db";

// エラーメッセージ、サイナップメッセージの初期化
$errorMessage = "";
$signupMessage = "";

// サイナップボタンが押されたら
if (isset($_POST["signUp"])) {
    // ユーザーIDの入力チェック
    if (empty($_POST['username'])) {
        $errorMessage = "ユーザーIDが未入力です";
    } else if (empty($_POST['password1'])) {
        $errorMessage = "パスワードが未入力です";
    } else if (empty($_POST['password2'])) {
        $errorMessage = "確認用パスワードが未入力です";
    }

    if (!empty($_POST['username']) && !empty($_POST['password1']) && !empty($_POST['password2']) && $_POST['password1'] == $_POST['password2']) {
        // 入力したユーザーIDとパスワードを取得
        $username = $_POST["username"];
        $password = $_POST["password1"];

        // PDOでDB接続
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB, DB_NAME);
        try { 
            $pdo = new PDO($dsn, DB_ID, DB_PW, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
            // ステートメントを用意
            $pre_query = 'INSERT INTO user_data(name, password) VALUES(?, ?)';
            $stmt = $pdo->prepare($pre_query);
            // ステートメントを実行
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
            // 登録したユーザーidを取得
            $userid = $pdo->lastinsertid();
            // サイナップメッセージを用意
            $signupMessage = "登録が完了しました。あなたのユーザーIDは".$userid."、ユーザー名は".$username."、パスワードは".$password."です。";
            // 登録が成功した時の処理

        } catch (PDOException $e) {
            $errorMessage = "DBエラー";
            var_dump($e->getMessage());
        }
    } else if (!empty($_POST['password1']) && !empty($_POST['password2']) && $_POST['password1'] != $_POST['password2']) {
        $errorMessage = "パスワードに誤りがあります。";
    }
}

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>

<h1>新規登録画面</h1>
<form id="loginForm" name="loginForm" action="" method="POST">
    <fieldset>
        <legend>新規登録フォーム</legend>
        <div><font color="#ff0000"><?= h($errorMessage); ?></font></div>
        <div><font color="#0000ff"><?= h($signupMessage); ?></font></div>
        <label for="username">ユーザー名</label><input type="text" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST["username"])) {echo h($_POST["username"]);} ?>">
        <br>
        <label for="password1">パスワード</label><input type="password" id="password1" name="password1" value="" placeholder="パスワードを入力">
        <br>
        <label for="password2">パスワード(確認用)</label><input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
        <br>
        <input type="submit" id="signUp" name="signUp" value="新規登録">
    </fieldset>
</form>
<br>
<form action="login.php">
    <input type="submit" value="戻る">
</form>
