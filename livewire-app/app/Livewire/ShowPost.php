<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title; // タイトル設定用
use Livewire\Component;

#[Layout('components.layouts.guest')]
class ShowPost extends Component
{
    public Post $post; // 1件のデータを格納する箱

    // URLの {post} 部分が、自動的にこの引数に渡されます
    // 型指定 (Post $post) をすることで、Laravelが勝手に「ID検索」をしてくれます
    public function mount(Post $post)
    {
        $this->post = $post;
    }

    // ページタイトルを記事のタイトルにする（動的設定）
    public function render()
    {
        return view('livewire.show-post')
            ->title($this->post->title); 
    }
}
