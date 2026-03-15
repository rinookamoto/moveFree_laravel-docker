プロジェクトのセットアップ方法
本プロジェクトを起動するために、Docker 環境を構築します。

1. 前提条件
   Docker / Docker Desktop がインストールされていること

2. 環境の構築手順
   ① リポジトリのクローンと移動
   Bash

git clone <リポジトリ URL>
cd <プロジェクト名>
② 環境変数の準備
Laravel の設定ファイルを生成します。

Bash

cp src/.env.example src/.env
③ コンテナの起動
Docker コンテナをビルドし、バックグラウンドで起動します。

Bash

docker-compose up -d --build
④ アプリのセットアップ
コンテナ内で依存パッケージのインストールや、データベースのセットアップを行います。

PHP 依存ライブラリのインストール

Bash

docker-compose exec app composer install
アプリキーの生成

Bash

docker-compose exec app php artisan key:generate
データベースのマイグレーション

Bash

docker-compose exec app php artisan migrate
⑤ フロントエンドのセットアップ
本プロジェクトは Vite および Tailwind CSS を使用しているようです。

Bash

docker-compose exec app npm install
docker-compose exec app npm run dev
各サービスへのアクセス
Web アプリケーション: http://localhost:8080

データベース: localhost:3308 (ユーザー名・パスワード等は src/.env を参照)
