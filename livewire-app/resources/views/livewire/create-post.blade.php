<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-6">記事の新規投稿</h2>

    @if (session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <flux:input 
            wire:model="title" 
            label="タイトル" 
            placeholder="記事のタイトルを入力"
        />
        <flux:textarea 
            wire:model="content" 
            label="本文" 
            rows="5" 
            placeholder="ここに本文を書きます"
        />

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">
                投稿する
            </flux:button>
        </div>
    </form>
</div>