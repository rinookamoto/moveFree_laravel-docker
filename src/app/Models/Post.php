<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // どの項目を保存していいかを指定（これがないと保存時にエラーになります）
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * この投稿を所有するユーザーを取得する
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}