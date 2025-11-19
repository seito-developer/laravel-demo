<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todo_tag', function (Blueprint $table) {
            // 中間テーブルには id や timestamps は不要なことが多い
            
            $table->foreignId('todo_id')
                ->constrained('todos')
                ->onDelete('cascade');
                
            $table->foreignId('tag_id')
                ->constrained('tags')
                ->onDelete('cascade');
                
            // (todo_id, tag_id) のペアで重複を禁止する (複合プライマリキー)
            $table->primary(['todo_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_tag');
    }
};
