<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'seito.horiguchi@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // 2. ランダムなユーザーを3名作成
        $randomUsers = User::factory(3)->create();

        // 3. 全ユーザー（固定1 + ランダム3）をひとつのコレクションにまとめる
        $allUsers = $randomUsers->push($testUser);

        // 4. 100件の記事を作成（作成したユーザーたちをランダムに割り当て）
        // recycle() を使うと、既存のモデル($allUsers)の中からランダムに選んで user_id に入れてくれます
        Post::factory(100)
            ->recycle($allUsers)
            ->create();
    }
}
