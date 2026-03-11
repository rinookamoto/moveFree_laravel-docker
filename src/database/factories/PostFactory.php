<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title' => fake()->realText(20),  // 20文字くらいのランダムなタイトル
        'body' => fake()->realText(200), // 200文字くらいのランダムな本文
        'user_id' => \App\Models\User::factory(), // 投稿者として新しいユーザーも自動作成
    ];
}
}
