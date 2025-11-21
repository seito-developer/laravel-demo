<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePost extends Component
{
    #[Validate('required|min:3', message: 'タイトルは3文字以上で入力してください')]
    public $title = '';

    #[Validate('required', message: '本文は必須です')]
    public $content = '';

    public function save()
    {
        // バリデーション実行（属性で指定したルールが適用される）
        $this->validate();

        // データの保存
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => Auth::id()
        ]);

        // 完了後のリセットと通知
        $this->reset(['title', 'content']);
        session()->flash('status', '記事を投稿しました！');
        
        // 投稿一覧ページへ移動（後で作ります）
        return $this->redirect('/posts', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
