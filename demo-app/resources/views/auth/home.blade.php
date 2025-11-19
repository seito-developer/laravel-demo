@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <p>ホーム画面</p>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
    </form>
@endsection