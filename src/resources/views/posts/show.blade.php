<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- 文字コード設定 -->
    <meta charset="UTF-8">

    <!-- レスポンシブ対応 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ページタイトル（記事タイトルを表示） -->
    <title>{{ $post->title }} - 詳細</title>

    <!-- TailwindCSS読み込み（CDN） -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- ナビゲーションバー -->
    <nav class="bg-white shadow-sm p-4 mb-8">

        <div class="max-w-3xl mx-auto flex justify-between items-center">

            <a href="/" class="text-xl font-bold text-gray-800">
                ブログシステム
            </a>

            <a href="/" class="text-blue-600 hover:underline">
                ← 戻る
            </a>

        </div>
    </nav>

    <!-- メイン -->
    <main class="max-w-3xl mx-auto px-4">

        <!-- 記事表示カード -->
        <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">

            <!-- 記事タイトル -->
            <h1 class="text-3xl font-bold mb-4 text-gray-900">
                {{ $post->title }}
            </h1>

            <!-- 投稿者・投稿日 -->
            <div class="flex items-center text-sm text-gray-500 mb-8 pb-4 border-b">

                <span class="mr-4">
                    投稿者: {{ $post->user->name ?? 'ゲスト' }}
                </span>

                <span>
                    投稿日: {{ $post->created_at->format('Y/m/d H:i') }}
                </span>

            </div>

            <!-- 記事本文 -->
            <div class="text-gray-800 leading-relaxed whitespace-pre-wrap mb-10">
                {{ $post->body }}
            </div>

            <!-- ログインユーザー判定 -->
            @auth

                <!-- 自分の記事かどうか判定 -->
                @if(Auth::id() === $post->user_id)

                    <!-- 記事管理ボタン（編集・削除） -->
                    <div class="flex gap-4 border-t pt-6">

                        <a href="{{ route('posts.edit', $post->id) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow-sm transition">
                            編集する
                        </a>

                        <form action="{{ route('posts.destroy', $post->id) }}"
                              method="POST"
                              onsubmit="return confirm('本当に削除しますか？');">

                            @csrf

                            <!-- DELETEメソッド指定 -->
                            @method('DELETE')

                            <!-- 削除ボタン -->
                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow-sm transition">
                                削除する
                            </button>

                        </form>

                    </div>

                @endif

            @endauth 

        </article>

    </main>

</body>
</html>