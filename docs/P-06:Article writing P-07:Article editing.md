### 詳細設計　(イベント処理)　 P-06: Article writing

## 開発メモ

app/Http/Requests/StorePostRequest.php
rules メソッド：title（必須/255 字）、body（必須）を定義。
app/Http/Controllers/PostController.php
create メソッド：view('posts.create') を返却。
store メソッド：StorePostRequest で検証後、$request->user()->posts()->create($request->validated()) で保存。
resources/views/posts/create.blade.php

<form action="{{ route('posts.store') }}" method="POST"> を記述。
@csrf ディレクティブを必ず含める。

1. 画面概要
   ログインユーザーが新しい記事を執筆・投稿するための画面です。
   | 項目 | 内容 |
   | :------ | :------------------------------------- |
   | 画面名 | 記事作成 |
   | パス（URL） | /posts/create |
   | アクセス権限 | ログイン済みユーザーのみ（auth ミドルウェアによる保護） |
   | 主な構成要素 | タイトル入力欄、本文入力欄（textarea）、保存ボタン、キャンセルボタン |

2. イベント処理詳細 (Event Handling)

| 発生タイミング | アクション（Laravel 実装） | HTTP メソッド | ルート名     | 処理内容詳細                                                                                              | 遷移先   |
| :------------- | :------------------------- | :------------ | :----------- | :-------------------------------------------------------------------------------------------------------- | :------- |
| 画面表示時     | PostController@create      | GET           | posts.create | 1. 空の投稿フォームを表示する。                                                                           | 自画面   |
| 保存ボタン押下 | PostController@store       | POST          | posts.store  | 1. バリデーション（L-03）を実行する。<br>2. ログインユーザーの user_id を付与し、記事を保存する（L-04）。 | P-04：DB |

3. ロジック処理詳細 (Logic Processing)

| 処理 ID | 処理名             | 実装内容詳細                                                                                        | 関連テーブル |
| :------ | :----------------- | :-------------------------------------------------------------------------------------------------- | :----------- |
| L-03    | 投稿バリデーション | タイトル：必須入力・255 文字以内。<br>本文：必須入力。                                              | -            |
| L-04    | データ保存処理     | auth()->user()->posts()->create($request->all()) を実行し、posts テーブルへ新規レコードを作成する。 | posts        |
