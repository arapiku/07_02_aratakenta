# Gs DEV9 php-db課題

## 使用した技術要素
- XAMPP 5.6.3
- PHP 5.6.3
- Apache 2.4.10
- MySQL 5.6.21
- phpMyAdmin 4.2.11
- Amazon Product Advertising API

## ディレクトリ構成
  ```
  .
  ├── css/ .. cssフォルダ
    └── style.css .. スタイルシート
  ├── tempaltes/ .. テンプレートフォルダ
    ├── header.php .. ヘッダー
    └── footer/ .. フッター
  ├── index.php .. トップ
  ├── signup.php .. 新規登録
  ├── login.php .. ログイン
  ├── logout.php .. ログアウト
  ├── mypage.php .. マイページ
  ├── search.php .. 検索
  ├── search_result.php .. APIの検索結果を返す
  └── book_save.php .. 本データを保存する

  ```

## DB構成
- user_data

| カラム名              　   | 定義                |
|:-------------------------|:-------------------:|
| id                       | int(12), primary key, auto_increment |
| name                     | varchar(20) not null  |
| password                 | varchar(100) not null |

- post_data

| カラム名                  | 定義                |
|:-------------------------|:-------------------:|
| id                       | int(12), primary key, auto_increment |
| uid                      | int(12) not null |
| title                    | varchar(255) |
| author                   | varchar(255) |
| image                    | varchar(255) |



## 留意事項
Amazon Product Advertising APIを利用するために、以下３点が必要になります
- aws_access_key_id
- aws_secret_key
- AssociateTag

[Amazonアソシエイト](https://affiliate.amazon.co.jp/)
ローカル開発環境で扱う場合、審査が通らないので、日毎に登録し直さないと使えなくとても不便です。。。