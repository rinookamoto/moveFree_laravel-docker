# データベース設計書

## テーブル一覧

### 1. users (ユーザー情報)

ログインおよび会員管理に使用します。

| カラム名   | 型        | 制約        | 説明                     |
| :--------- | :-------- | :---------- | :----------------------- |
| id         | bigint    | Primary Key | ユーザー ID              |
| name       | string    | Not Null    | 表示名                   |
| email      | string    | Unique      | ログイン用メールアドレス |
| password   | string    | Not Null    | パスワード（暗号化済み） |
| created_at | timestamp | -           | 登録日時                 |

### 2. posts (投稿記事)

ブログの記事データを保存します。

| カラム名   | 型          | 制約        | 説明                  |
| :--------- | :---------- | :---------- | :-------------------- |
| id         | bigint      | Primary Key | 記事 ID               |
| user_id    | bigint      | Foreign Key | 投稿したユーザーの ID |
| title      | string(255) | Not Null    | 記事のタイトル        |
| body       | text        | Not Null    | 記事の本文            |
| created_at | timestamp   | -           | 投稿日時              |
| updated_at | timestamp   | -           | 更新日時              |

## リレーション（関連図）

- **users : posts = 1 : 多**
  - 1 人のユーザーは複数の記事を投稿できます。
  - 1 つの記事は必ず 1 人のユーザーに紐付きます。
