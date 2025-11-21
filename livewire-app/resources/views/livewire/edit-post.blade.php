<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-6">記事の編集</h2>

    <form wire:submit="update" class="space-y-6">
        <flux:input wire:model="title" label="タイトル" />
        
        <flux:textarea wire:model="content" label="本文" rows="5" />

        <div class="flex justify-end gap-2">
            <flux:button href="{{ route('my-posts') }}" wire:navigate>
                キャンセル
            </flux:button>

            <flux:button type="submit" variant="primary">
                更新する
            </flux:button>
        </div>
    </form>
</div>