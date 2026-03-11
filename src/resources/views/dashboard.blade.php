<x-app-layout>

    <!-- ページヘッダー -->
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <!-- ページタイトル -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('マイページ（投稿管理）') }}
            </h2>

            <!-- 新規投稿ボタン -->
            <a href="{{ route('posts.create') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                新規投稿
            </a>

        </div>
    </x-slot>

    <!-- メインコンテンツエリア -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- 投稿一覧カード -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- 投稿一覧タイトル -->
                <h3 class="text-lg font-medium mb-4">あなたの投稿記事一覧</h3>

                <!-- 投稿一覧テーブル -->
                <table class="min-w-full divide-y divide-gray-200">

                    <!-- テーブルヘッダー -->
                    <thead>
                        <tr>
                            <!-- タイトル列 -->
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                タイトル
                            </th>

                            <!-- 投稿日列 -->
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                投稿日
                            </th>

                            <!-- 操作列 -->
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                操作
                            </th>
                        </tr>
                    </thead>

                    <!-- 投稿データ一覧 -->
                    <tbody class="bg-white divide-y divide-gray-200">

                        <!-- 投稿ループ -->
                        @foreach($posts as $post)
                        <tr>

                            <!-- 投稿タイトル（詳細ページリンク） -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="text-blue-600 hover:text-blue-900">
                                    {{ $post->title }}
                                </a>
                            </td>

                            <!-- 投稿日 -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post->created_at->format('Y/m/d') }}
                            </td>

                            <!-- 投稿操作 -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                <!-- 編集リンク -->
                                <a href="{{ route('posts.edit', $post) }}" 
                                   class="text-green-600 hover:text-green-900 mr-3">
                                    編集
                                </a>

                                <!-- 削除フォーム -->
                                <form action="{{ route('posts.destroy', $post) }}" 
                                      method="POST" 
                                      class="inline">

                                    @csrf

                                    <!-- DELETEメソッド指定 -->
                                    @method('DELETE')

                                    <!-- 削除ボタン -->
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('本当に削除しますか？')">
                                        削除
                                    </button>

                                </form>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>