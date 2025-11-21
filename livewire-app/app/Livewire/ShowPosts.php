<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.guest')]
#[Title('記事一覧ページ')]
class ShowPosts extends Component
{
    use WithPagination;

    // 検索ワード用プロパティ（URLにも反映させる）
    #[Url]
    public $search = '';

    // 検索ワードが更新されたら、ページネーションをリセットする
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::with('user')
            ->where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }
}
