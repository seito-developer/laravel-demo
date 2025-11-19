<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'is_completed', 'project_id'];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    /**
     * このタスクが属するプロジェクトを取得
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    
    /**
     * このタスクに紐付くタグを取得
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class); // 中間テーブル名は自動で推測してくれる
    }
}
