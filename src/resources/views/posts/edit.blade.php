<x-app-layout>

    <!-- ヘッダー -->
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記事の編集') }}
        </h2>

    </x-slot>

    <!-- メインコンテンツ -->
    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- 編集フォームカード -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- 記事更新フォーム -->
                <form action="{{ route('posts.update', $post->id) }}" method="POST">

                    @csrf

                    <!-- HTTPメソッドを変更 -->
                    @method('PATCH')

                    <!-- タイトル入力欄 -->
                    <div class="mb-4">

                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            タイトル
                        </label>

                        <input 
                            type="text" 
                            name="title" 
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('title', $post->title) }}"
                        >

                        <!-- バリデーションエラー表示 -->
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- 本文入力欄 -->
                    <div class="mb-6">

                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            本文
                        </label>

                        <!-- 本文テキスト -->
                        <textarea 
                            name="body" 
                            rows="10" 
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('body', $post->body) }}</textarea>

                        <!-- バリデーションエラー表示 -->
                        @error('body')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- 操作ボタン -->
                    <div class="flex items-center justify-between">

                        <!-- 更新ボタン -->
                        <button 
                            type="submit" 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        >
                            更新する
                        </button>

                        <!-- キャンセルリンク（ダッシュボードへ戻る） -->
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">
                            キャンセル
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>