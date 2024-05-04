@extends('layouts.logout')

@section('content')
{!! Form::open(['url' => 'login']) !!}

<div class="login_content">
    <p class="login_text">AtlasSNSへようこそ</p>
    <div class="login_mail">
        <div class="login_label">
            {{ Form::label('メールアドレス') }}
        </div>
        <div>
            {{ Form::text('mail',null,['class' => 'input']) }}
        </div>
    </div>
    <div class="login_pass">
        <div class="login_label">
            {{ Form::label('パスワード') }}
        </div>
        <div>
            {{ Form::password('password',['class' => 'input']) }}
        </div>
    </div>
    <div class="button">
        {{ Form::submit('ログイン',['class' => 'login_btn']) }}
    </div>
    <p class="new_user"><a href="/register">新規ユーザーの方はこちら</a></p>
</div>

{!! Form::close() !!}

@endsection
