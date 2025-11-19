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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->foreignId('project_id') // ◀ project_id カラム
                ->constrained('projects') // ◀ projects テーブルの id と紐付け
                ->onDelete('cascade');  // ◀ プロジェクトが削除されたら、タスクも削除

            $table->string('title'); // タスクのタイトル
            $table->text('description')->nullable(); // 詳細（nullでもOK）
            $table->boolean('is_completed')->default(false); // 完了フラグ（デフォルトはfalse=未完了）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
