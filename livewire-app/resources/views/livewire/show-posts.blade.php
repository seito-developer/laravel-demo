<div class="space-y-4">
    <h1 class="text-2xl font-bold">記事一覧</h1>
    <div class="flex justify-between items-center mb-6">
        <flux:input 
            wire:model.live.debounce.300ms="search" 
            placeholder="タイトルで検索..." 
            icon="magnifying-glass" 
            class="w-64"
        />
        <div> 
            @auth
                <flux:button href="{{ route('posts.create') }}" wire:navigate variant="primary">
                    新規作成
                </flux:button>
            @endauth
        </div>
    </div>

    @foreach($posts as $post)
        <article class="p-4 shadow-lg bg-white dark:bg-gray-800">
            <a href="/posts/{{ $post->id }}" wire:navigate class="block group">
                <flux:text class="mt-4">
                    {{ $post->created_at->format('Y/m/d') }}
                </flux:text>
                <flux:heading size="lg" level="2">{{ $post->title }}</flux:heading>
                <flux:text class="mt-2">{{ Str::limit($post->content, 100) }}</flux:text>
                <flux:text class="mt-4">
                    投稿者: {{ $post->user->name }}
                </flux:text>
            </a>
        </article>
    @endforeach

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
