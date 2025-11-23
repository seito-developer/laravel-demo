<div class="max-w-4xl mx-auto p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold">自分の投稿一覧</h2>
        <flux:button href="{{ route('posts.create') }}" variant="primary" wire:navigate>
            新規作成
        </flux:button>
    </div>

    @if (session('status'))
        <div class="p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    @foreach($posts as $post)
        <article class="shadow-lg flex flex-col md:flex-row justify-between items-start gap-4 p-4">
            <div>
                <h3 class="text-lg font-bold">{{ $post->title }}</h3>
                <p class="text-sm text-gray-500 mt-1">
                    投稿日: {{ $post->created_at->format('Y/m/d H:i') }}
                </p>
                <p class="mt-2 mb-5 text-gray-600 truncate max-w-xl">
                    {{ Str::limit($post->content, 100) }}
                </p>
                <flux:button 
                    href="/posts/{{ $post->id }}" 
                    variant="ghost" 
                    class="block group">
                    記事を見る
                </flux:button>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <flux:button 
                    href="/posts/{{ $post->id }}/edit" 
                    icon="pencil-square" 
                    size="sm"
                >
                    編集
                </flux:button>

                <flux:button 
                    wire:click="delete({{ $post->id }})" 
                    wire:confirm="本当に削除してもよろしいですか？"
                    variant="danger" 
                    icon="trash" 
                    size="sm"
                >
                    削除
                </flux:button>
                
            </div>
        </article>
    @endforeach

    {{ $posts->links() }}
</div>