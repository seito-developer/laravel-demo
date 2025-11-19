<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    
    // (CH3で使います)
    protected $fillable = ['name', 'user_id']; 

    /**
     * このプロジェクトを所有するユーザーを取得
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * このプロジェクトに属するタスクを取得
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }
}
