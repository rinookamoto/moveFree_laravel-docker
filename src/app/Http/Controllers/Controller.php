<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
{
    // 1. Postモデルから全記事を最新順（latest）で取得する
    // 2. 1ページあたり10件のページネーションを実施する（設計書指定）
    $posts = \App\Models\Post::latest()->paginate(10);

    // posts.index ビューへデータを渡す
    return view('posts.index', compact('posts'));
}
}
