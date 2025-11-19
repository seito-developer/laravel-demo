<div {{ $attributes->merge([
    'class' => 'mt-2 text-sm text-white rounded-lg p-4 ' . $bg
]) }} role={{ $role }} tabindex="-1" aria-labelledby="hs-solid-color-dark-label">
    @isset($title)
        <span id="hs-solid-color-dark-label" class="font-bold">{{ $title }}</span> 
    @endisset
    {{ $slot }}
</div>