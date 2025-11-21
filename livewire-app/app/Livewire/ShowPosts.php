<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('記事一覧ページ')]
class ShowPosts extends Component
{
    public function render()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }
}
