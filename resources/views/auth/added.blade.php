@extends('layouts.logout')

@section('content')

<div id="clear">
    <div class="added_username">
        <p>{{$username}}さん</p>
        <p>ようこそ！AtlasSNSへ</p>
    </div>
    <div class="added_text">
        <p>ユーザー登録が完了いたしました。</p>
        <p>早速ログインをしてみましょう！</p>
    </div>
    <p class="loginBack_btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
