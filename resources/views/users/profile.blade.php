@extends('layouts.login')

@section('content')

<div class="update_content">
    <div class="user_icon">
        <img src="{{ asset('images/'.$user->images )}}" alt="User Icon">
    </div>
    {!! Form::open(['url' => '/update', 'method' => 'post', 'files' => true]) !!}
        <div class="form_group">
            <div class="form_item">
                {{ Form::label('username','ユーザー名', ['class' => 'label_class']) }}
                {{ Form::input('text', 'username', $user->username, ['class' => 'form_control','placeholder' => 'ユーザー名を入力してください。']) }}
            </div>
            <div class="form_item">
                {{ Form::label('mail','メールアドレス', ['class' => 'label_class']) }}
                {{ Form::input('text', 'mail', $user->mail, ['class' => 'form_control','placeholder' => 'メールアドレスを入力してください。']) }}
            </div>
            <div class="form_item">
                {{ Form::label('password','パスワード', ['class' => 'label_class']) }}
                {{ Form::password('password', ['class' => 'form_control','placeholder' => 'パスワードを入力してください。']) }}
            </div>
            <div class="form_item">
                {{ Form::label('password_confirmation','パスワード確認', ['class' => 'label_class']) }}
                {{ Form::password('password_confirmation', ['class' => 'form_control','placeholder' => '確認用パスワードを入力してください。']) }}
            </div>
            <div class="form_item">
                {{ Form::label('bio','自己紹介', ['class' => 'label_class']) }}
                {{ Form::input('text', 'bio', $user->bio, ['class' => 'form_control','placeholder' => '自己紹介を入力してください。']) }}
            </div>
            <div class="form_item">
                {{ Form::label('icon_image', 'アイコン画像', ['class' => 'label_class']) }}
                <div class="custom_file_input">
                    <input type="file" id="realFile" name="icon_image" hidden="hidden">
                    <button type="button" id="customButton"><p>ファイルを選択</p></button>
                    <span id="customText"></span>
                </div>
            </div>
            <button type="submit" class="update_btn">更新</button>
        </div>
    {!! Form::close() !!}
</div>
@endsection
