### 詳細設計　(イベント処理)　 P-04: Mypage

## 開発メモ

※ Laravel Breeze 標準では dashboard ルートは View を直接返す設定が多いですが、記事一覧を表示する場合は PostController 等に処理を委譲するのが一般的です。
Controller: app/Http/Controllers/PostController.php (または専用の DashboardController)
Route 定義例:
// ログイン必須のグループ
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
View: resources/views/dashboard.blade.php

Laravel Breeze が生成する既存のダッシュボードレイアウトをベースに、記事一覧のループ処理を追加実装します。

1. 画面概要
   ログイン済みのユーザーが、自身の投稿した記事を一元管理するための専用画面です。
   | 項目 | 内容 |
   | :------ | :--------------------------------------------------------------- |
   | 画面名 | ダッシュボード（マイページ） |
   | パス（URL） | /dashboard |
   | アクセス権限 | ログイン済みユーザーのみ（auth ミドルウェアによるアクセス制御） |
   | 主な構成要素 | ログインユーザー名表示、自身の投稿記事一覧（テーブルまたはリスト形式）、新規投稿ボタン、編集リンク、削除リンク、ログアウトボタン |

2. イベント処理詳細 (Event Handling)

| 発生タイミング       | アクション（Laravel 実装）             | HTTP メソッド | ルート名     | 処理内容詳細                                                                                                                             | 遷移先           |
| :------------------- | :------------------------------------- | :------------ | :----------- | :--------------------------------------------------------------------------------------------------------------------------------------- | :--------------- |
| 画面表示時           | AuthenticatedSessionController@index ※ | GET           | dashboard    | 1. ログインユーザー ID に紐づく記事のみを取得する（L-01）。<br>2. dashboard.blade.php をレンダリングする。                               | 自画面           |
| 新規投稿ボタン押下   | リンククリック                         | GET           | posts.create | 1. 記事新規作成フォーム画面を表示する。                                                                                                  | P-06：記事作成   |
| 記事タイトル押下     | リンククリック                         | GET           | posts.show   | 1. 該当記事の ID をパラメータとして送信する。<br>2. 記事詳細画面を表示する。                                                             | P-05：記事詳細   |
| ログアウトボタン押下 | AuthenticatedSessionController@destroy | POST          | logout       | 1. 現在のセッションを破棄する。<br>2. session()->invalidate() および regenerateToken() を実行する。<br>3. トップ画面へリダイレクトする。 | P-01：トップ画面 |

3. ロジック処理詳細 (Logic Processing)

   | 処理 ID | 処理名                   | 実装内容詳細                                                                                                                                             | 関連テーブル |
   | :------ | :----------------------- | :------------------------------------------------------------------------------------------------------------------------------------------------------- | :----------- |
   | L-01    | 自分の記事一覧取得       | auth()->user()->posts()->latest()->get() を実行する。ログインユーザーと posts テーブルのリレーションを利用し、自身が投稿した記事のみを最新順で取得する。 | posts, users |
   | L-02    | アクセス制限             | routes/web.php にて middleware(['auth']) を適用する。未ログインユーザー（ゲスト）がアクセスした場合、ログイン画面へリダイレクトする。                    | なし         |
   | L-03    | 削除処理（イベント連動） | PostController@destroy を呼び出す。findOrFail() により対象記事の存在を確認後、delete() を実行して削除処理を行う。                                        | posts        |
