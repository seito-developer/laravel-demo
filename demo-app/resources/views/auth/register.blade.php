@if ($errors->any())
    <div>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif
<p>登録画面</p>
<form method="post" action="{{ route('register') }}">
    @csrf
    <div>
        <label for="name">名前</label>
        <input id="name" type="text" name="name">
    </div>
    <div>
        <label for="email">メールアドレス</label>
        <input id="email" type="text" name="email">
    </div>
    <div>
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password">
    </div>
    <div>
        <label for="password_confirmation">パスワード再入力</label>
        <input id="password_confirmation" type="password" name="password_confirmation">
    </div>
    <button type="submit">ユーザー登録</button>
    <a href="{{ route('login') }}">ログイン</a>
</form>