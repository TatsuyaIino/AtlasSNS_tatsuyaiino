@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register']) !!}
<div class="register_content">
    <h2 class="register_text">新規ユーザー登録</h2>
    <div class="register_username">
        <div class="register_label">
            {{ Form::label('ユーザー名') }}
        </div>
        {{ Form::text('username',null,['class' => 'input']) }}
    </div>
    <div class="register_mail">
        <div class="register_label">
            {{ Form::label('メールアドレス') }}
        </div>
        {{ Form::text('mail',null,['class' => 'input']) }}
    </div>
    <div class="register_pass">
        <div class="register_label">
            {{ Form::label('パスワード') }}
        </div>
        {{ Form::password('password',['class' => 'input']) }}
    </div>
    <div class="register_pass">
        <div class="register_label">
            {{ Form::label('パスワード確認') }}
        </div>
        {{ Form::password('password_confirmation',['class' => 'input']) }}
    </div>
    <div class="button">
        {{ Form::submit('新規登録',['class' => 'register_btn']) }}
    </div>

    <p class="login_back"><a href="/login">ログイン画面に戻る</a></p>
</div>
{!! Form::close() !!}

@endsection
