@extends('layouts.app')

@section('title', 'Loginページ')

@section('content')

    <h2>ログイン</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div>
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember"> ログイン状態を記憶する
            </label>
        </div>

        <div>
            <button type="submit">ログイン</button>
        </div>
    </form>
@endsection
