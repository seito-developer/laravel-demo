<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class EditPost extends Component
{
    public Post $post;

    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('required')]
    public $content = '';

    // URLのパラメータから自動で $post を受け取る
    public function mount(Post $post)
    {
        // セキュリティ：本人の記事でなければ403エラー
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function update()
    {
        $this->validate();

        // 更新処理（念のためここでも本人確認）
        if ($this->post->user_id !== Auth::id()) {
            abort(403);
        }

        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('status', '記事を更新しました！');

        // マイページに戻る
        return $this->redirect('/my-posts', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}