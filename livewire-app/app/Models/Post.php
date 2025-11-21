<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    // 1. データの書き換えを許可する項目（Mass Assignment対策）
    // これを書かないと Post::create() でエラーになります
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    // 2. ユーザーとのリレーション（「記事は一人のユーザーに属する」）
    // これで $post->user->name のように書けるようになります
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
