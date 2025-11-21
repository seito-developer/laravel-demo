<?php

namespace Database\Factories;

use App\Models\User;
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
            // 日本語のそれっぽいタイトルと本文を自動生成
            'title' => fake()->realText(30),
            'content' => fake()->realText(200),
            
            // user_id は DatabaseSeeder で recycle() されるので、
            // 基本的にはそちらが優先されますが、単体で使う時のために定義しておきます
            'user_id' => User::factory(),
        ];
    }
}
