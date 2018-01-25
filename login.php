<?php
include_once "templates/header.php";
include_once "templates/footer.php";

// パスワードをハッシュ化する
require('password.php');

// セッションをスタート
session_start();

// db情報
const DB = "127.0.0.1";
const DB_ID = "root";
const DB_PW = "";
const DB_NAME = "gs_db";

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押されたら
if (isset($_POST['login'])) {
    // 値の空チェック
    if (empty($_POST['username'])){ 
        $errorMessage = "ユーザー名が未入力です。";
    } else if (empty($_POST['password'])) {
        $errorMessage =  "パスワードが未入力です。";
    }

    // 正常終了時
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        // ユーザー名を格納
        $username = $_POST['username'];

        // PDOでDB接続
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB, DB_NAME);
        try { 
            $pdo = new PDO($dsn, DB_ID, DB_PW, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
            $pre_query = 'SELECT * FROM user_data WHERE name = ?';
            $stmt = $pdo->prepare($pre_query);
            $stmt->execute([$username]);
            $password = $_POST['password'];

            if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    // セッションidのリジェネ
                    session_regenerate_id(true);
                    // 入力したユーザー名を受け取る
                    $_SESSION['ID'] = $row['id'];
                    $_SESSION['NAME'] = $row['name'];
                    header('Location: index.php');
                    exit();
                } else {
                    // 認証失敗時
                    $errorMessage = "入力したユーザーIDまたはパスワードに誤りがあります。";
                }
            } else {
                // 該当データなし
                $errorMessage = "入力したユーザーIDまたはパスワードに誤りがあります。";
            }
        } catch (PDOException $e) {
            $errorMessage = "DBエラー";
            var_dump($e->getMessage());
        }
    }
}

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>

<h1>LOGIN</h1>
<form id="loginForm" name="loginForm" action="" method="POST">
    <fieldset>
        <legend>SIGN IN</legend>
        <div><font color="#ff0000"><?= h($errorMessage); ?></font></div>
        <p><label for="username">USERNAME</label><input type="text" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST["username"])) {echo h($_POST["username"]);} ?>">
        </p>
        <p><label for="password">PASSWORD</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
        </p>
        <input type="submit" id="login" name="login" value="ログイン" class="button">
    </fieldset>
</form>
<br>
<form id="signupForm" action="signup.php">
    <fieldset>
        <input type="submit" value="新規登録はこちら" class="button">
    </fieldset>
</form>