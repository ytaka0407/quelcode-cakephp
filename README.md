# docker-mycakeapp2

- CakePHP 超入門のサンプルアプリ(オークションアプリ)の docker 環境

## docker 起動前の準備

- docker/php/Dockerfile の DOCKER_UID をホストと合わせる

  ```
  # ホストのuidを調べる
  id -u

  # docker/php/Dockerfile の ARG DOCKER_UID=1000 の右辺を↑で調べた値にする
  vim docker/php/Dockerfile
  ```

  - Mac ではこの手順は不要との説もある
  - Linux ではこれをやらないとゲスト側で作成したファイルをホスト側で編集できなくなる
  - Windows は知らん

## docker の起動方法

- docker-compose.yml がある場所で下記のコマンドを実行する。初回起動は時間がかかる

  ```
  docker-compose up -d
  ```

## docker の終了方法

- docker-compose.yml がある場所で下記のコマンドを実行する
  ```
  docker-compose down
  ```

## 起動中のコンテナの bash を実行する方法

- php コンテナの場合

  ```
  docker-compose exec php bash
  ```

- msyql コンテナの場合
  ```
  docker-compose exec mysql bash
  ```

## 起動中のコンテナの bash を終了する方法

- コンテナの bash 内で下記のショートカットキーを入力する

  ```
  ctrl + p + q
  ```

  - コンテナの bash 内で exit コマンドを打つとコンテナ自体が終了してしまう恐れがあるらしい

##

## php コンテナに cakephp をインストールする方法

- php コンテナの bash で/var/www/html/mycakeapp に移動して下記コマンドを実行する

  ```
  composer install
  ```

  - 時間が掛かる。最後に質問プロンプトが出たら yes と回答する

## nginx のドキュメントルートを変更する

1. docker/nginx/default.conf を下記のように書き換える

   - mylaravelapp という名前の laravel アプリを作成した場合

     ```diff
     server {
     - root  /var/www/html;
     + root  /var/www/html/mylaravelapp/public;
       index index.php index.html;
       ...
     ```

   - mycakephpapp という名前の cakephp アプリを作成した場合
     ```diff
     server {
     - root  /var/www/html;
     + root  /var/www/html/mycakephpapp/webroot;
       index index.php index.html;
       ...
     ```

1) ブラウザで http://localhost:10080 にアクセスすると laravel または cakephp のトップページが表示される

## 備考

- php コンテナの bash ユーザ: docker について

  - パスワード: docker
  - sudo 可能

- コーディング

  - ホスト側で php コンテナがマウントしている html 配下を編集する

- DB 接続(本番リリースを想定する場合は必ず再設定してください)
  - DB ホストは mysql
  - mysql の port は 3306
  - mysql のアカウントは docker-compose.yml を参照
    - MYSQL_DATABASE: docker_db
    - MYSQL_ROOT_PASSWORD: root
    - MYSQL_USER: docker_db_user
    - MYSQL_PASSWORD: docker_db_user_pass
