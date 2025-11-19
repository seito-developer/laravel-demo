@extends('layouts.app')

@section('title', '記事一覧ページ')

@section('content')
    <h2>ブログ記事一覧</h2>

    @forelse ($posts as $post)
        <article>
            <h3>{{ $post->title }}</h3>
            <p>{{ Str::limit($post->body, 100) }}</p>
        </article>
        <br>
    @empty
        <p>記事はまだ一件もありません。</p>
    @endforelse

@endsection
