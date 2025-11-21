<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPosts extends Component
{
    public function render()
    {
        $posts = Post::with('user')->latest()->get();

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }
}
