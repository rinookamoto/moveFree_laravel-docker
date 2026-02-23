### 詳細設計　(イベント処理)　 P-07: Article editing

## 開発メモ

app/Http/Controllers/PostController.php
edit メソッド：PostPolicy でアクセス権を確認。OK なら View へ記事データを渡す。
update メソッド：validated() データを取得し、$post->update($data) を実行。
resources/views/posts/edit.blade.php
既存の値を value="{{ old('title', $post->title) }}" の形式でセット。

<form> 内に @method('PATCH') または @method('PUT') を記述。
routes/web.php
Route::resource('posts', PostController::class)->middleware('auth'); で一括定義。

1. 画面概要
   既存の記事の内容を修正するための画面です。
   | 項目 | 内容 |
   | :------ | :------------------------------------ |
   | 画面名 | 記事編集 |
   | パス（URL） | /posts/{id}/edit |
   | アクセス権限 | 投稿者本人のみ（Policy または Gate による認可制御） |
   | 主な構成要素 | 既存のタイトルおよび本文が入力済みのフォーム、更新ボタン、キャンセルボタン |

2. イベント処理詳細 (Event Handling)

| 発生タイミング | アクション（Laravel 実装） | HTTP メソッド | ルート名     | 処理内容詳細                                                                                      | 遷移先     |
| :------------- | :------------------------- | :------------ | :----------- | :------------------------------------------------------------------------------------------------ | :--------- |
| 画面表示時     | PostController@edit        | GET           | posts.edit   | 1. Policy 等で投稿者本人であることを確認する。<br>2. 既存記事データを取得し、フォームへ反映する。 | 自画面     |
| 更新ボタン押下 | PostController@update      | PUT / PATCH   | posts.update | 1. バリデーションを実行する。<br>2. 対象記事データを上書き更新する（L-05）。                      | P-05：詳細 |

3. ロジック処理詳細 (Logic Processing)
   | 処理 ID | 処理名 | 実装内容詳細 | 関連テーブル |
   | :--- | :----- | :----------------------------------------------------------------------- | :----- |
   | L-05 | 更新実行処理 | $post->update($request->all()) を実行し、対象レコードを更新する。併せて updated_at カラムを更新する。 | posts |
