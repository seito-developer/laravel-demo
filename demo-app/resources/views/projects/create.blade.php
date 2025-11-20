@extends('layouts.app')

@section('title', 'プロジェクト作成')

@section('content')
    <h2>新しいプロジェクトを作成</h2>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        
        <div>
            <label for="name">プロジェクト名:</label>
            <input type="text" name="name" id="name" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">作成する</button>
    </form>

    <a href="{{ route('home') }}">戻る</a>
@endsection