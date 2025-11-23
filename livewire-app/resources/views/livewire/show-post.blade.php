<div class="max-w-3xl mx-auto p-6 shadow-lg bg-white">
    <div class="mb-6">
        <flux:button href="{{ route('posts') }}" wire:navigate icon="arrow-left" variant="subtle">
            一覧に戻る
        </flux:button>
    </div>

    <div class="mb-8 border-b border-zinc-200 pb-6 dark:border-zinc-700">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        
        <div class="flex items-center text-sm text-gray-500 gap-4 p-2">
            <div class="flex items-center gap-1">
                <flux:icon.user class="w-4 h-4" />
                <span>{{ $post->user->name }}</span>
            </div>
            <div class="flex items-center gap-1">
                <flux:icon.calendar class="w-4 h-4" />
                <span>{{ $post->created_at->format('Y年m月d日') }}</span>
            </div>
        </div>
    </div>

    <div class="text-lg leading-relaxed text-gray-800 dark:text-gray-200 whitespace-pre-wrap mt-5">
        {!! nl2br(e($post->content)) !!}
    </div>
    
</div>