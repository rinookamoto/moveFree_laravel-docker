<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>トップ画面 - ブログシステム</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- ナビゲーションバー -->
    <nav class="bg-white shadow-sm p-4 mb-8">

        <div class="max-w-5xl mx-auto flex justify-between items-center">

            <!-- サイトタイトル -->
            <h1 class="text-xl font-bold text-gray-800">ブログシステム</h1>

            <div>

                <!-- ログイン状態判定 -->
                @auth

                    <!-- マイページリンク -->
                    <a href="{{ route('dashboard') }}" class="text-gray-600 mr-4 font-medium hover:text-blue-600">
                        マイページ
                    </a>

                    <!-- ログアウトフォーム -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">

                        @csrf

                        <!-- ログアウトボタン -->
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                            ログアウト
                        </button>

                    </form>

                <!-- 未ログインの場合 -->
                @else

                    <!-- ログインリンク -->
                    <a href="{{ route('login') }}" class="text-gray-600 mr-4">
                        ログイン
                    </a>

                    <!-- 会員登録リンク -->
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        会員登録
                    </a>

                @endauth

            </div>
        </div>
    </nav>

    <!-- =========================
         メインコンテンツ
    ========================= -->
    <main class="max-w-5xl mx-auto px-4">

        <!-- 記事一覧タイトル -->
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            最新記事一覧
        </h2>

        <!-- =========================
             記事カード一覧グリッド
        ========================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- 記事ループ -->
            @foreach($posts as $post)

                <!-- 記事カード -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">

                    <div class="p-6">

                        <!-- 記事タイトル -->
                        <h3 class="text-xl font-bold mb-2 text-blue-600">

                            <!-- 記事詳細ページリンク -->
                            <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                                {{ $post->title }}
                            </a>

                        </h3>

                        <!-- =========================
                             ログインユーザー確認
                        ========================= -->
                        @auth

                            <!-- 自分の記事かどうか判定 -->
                            @if($post->user_id === auth()->id())

                                <!-- 編集リンク -->
                                <div class="flex space-x-2 mb-4">

                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-sm text-green-600 hover:text-green-800 font-medium">
                                        [編集する]
                                    </a>

                                </div>

                            @endif

                        @endauth

                        <!-- 記事本文（抜粋表示） -->
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $post->body }}
                        </p>

                        <!-- =========================
                             投稿情報（投稿者・日付）
                        ========================= -->
                        <div class="flex justify-between items-center text-sm text-gray-500 border-t pt-4">

                            <!-- 投稿者名 -->
                            <span>
                                投稿者: {{ $post->user->name ?? 'ゲスト' }}
                            </span>

                            <!-- 投稿日 -->
                            <span>
                                {{ $post->created_at->format('Y/m/d') }}
                            </span>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

        <!-- =========================
             フッター余白エリア
        ========================= -->
        <div class="mt-10 mb-20 text-center text-gray-400">
        </div>

    </main>

</body>
</html>