<div class="space-y-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">記事一覧</h1>
        <flux:button href="{{ route('posts.create') }}" wire:navigate variant="primary">
            新規作成
        </flux:button>
    </div>

    @foreach($posts as $post)
        <article class="p-4 shadow-lg">
            <flux:text class="mt-4">
                {{ $post->created_at->format('Y/m/d') }}
            </flux:text>
            <flux:heading size="lg" level="2">{{ $post->title }}</flux:heading>
            <flux:text class="mt-2">{{ Str::limit($post->content, 100) }}</flux:text>
            <flux:text class="mt-4">
                投稿者: {{ $post->user->name }}
            </flux:text>
        </article>
    @endforeach
</div>
