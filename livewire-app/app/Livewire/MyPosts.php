<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('自分が書いた記事一覧ページ')]
class MyPosts extends Component
{
    use WithPagination;

    // 削除処理（ボタンが押されたらここが動く）
    public function delete($id)
    {
        $post = Post::find($id);

        // セキュリティ：他人の記事を消そうとしていないかチェック
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();
        
        session()->flash('status', '記事を削除しました。');
    }

    public function render()
    {
        // 自分の記事だけを取得
        $posts = Post::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('livewire.my-posts', [
            'posts' => $posts
        ]);
    }
}