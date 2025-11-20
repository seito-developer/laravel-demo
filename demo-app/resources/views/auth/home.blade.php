@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <p>ホーム画面</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>

    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
        Dark mode
    </button>

    @push('scripts')
        @vite('resources/js/dark-mode-button.js')
    @endpush
@endsection

