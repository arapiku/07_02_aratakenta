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
?>
<h1>検索ページ</h1>
<form id="searchform" method="post">
<div>
    <label for="search_term">入力してね</label>
    <input type="text" name="search_term" id="search_term" />
    </div>
</form>
<div id="search_results"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
$("#search_results").slideUp();
    $("#search_term").keyup(function(e){
        e.preventDefault();
        ajax_search();
    });

});
// APIの取得結果を返す
function ajax_search(){
    $("#search_results").show();
    var search_val=$("#search_term").val();
    $.post("./search_result.php", {search_term : search_val}, function(data){
        if (data.length>0){
            $("#search_results").html(data);
        }
    });
}
</script>