<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- 文字コード -->
    <meta charset="utf-8">

    <!-- レスポンシブ設定 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRFトークン（Ajaxやフォーム送信のセキュリティ用） -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- タイトル -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- フォント -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- TailwindCSS（CDN） -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- JavaScript -->

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<!-- ページ本体 -->
<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">

        <!-- ナビゲーションバー -->
        @include('layouts.navigation')

        <!-- ヘッダー -->
        @isset($header)

            <header class="bg-white shadow">

                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                    {{ $header }}

                </div>

            </header>

        @endisset

        <!-- メイン -->
        <main>

            {{ $slot }}

        </main>

    </div>

</body>
</html>