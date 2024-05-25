@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/post']) !!}
<div class="post_content">
    <div class="user_icon">
        <img src="images/{{ $user->images }}" alt="User Icon">
    </div>
    <div class="post_group">
        {!! Form::textarea('content',null,['class' => 'form_control','rows' => 6,'placeholder' => '投稿内容を入力してください。']) !!}
    </div>
    <div class="post_icon">
        <button type="submit" class="image-button"></button>
    </div>
</div>
{!! Form::close() !!}

<div class="post_list">
    <div class="post_item">
        @foreach ($posts as $post)
            <div class="post_flex">
                <div class="user_img">
                    <img src="images/{{ $post->user->images }}" alt="User Icon" class="user_icon">
                </div>
                <div class="post_text">
                    <span class="username">{{ $post->user->username }}</span>
                    <p>{{ $post->post }}</p>
                </div>
                <div class="post_date">
                    <span class="date">{{ $post->created_at->format('Y-m-d H:i') }}</span>
                </div>
            </div>
            @if($post->user->id == $user->id)
                <div class="post_actions">
                    <a href="#" class="edit_btn" data-id="{{ $post->id }}"><img src="images/edit.png" alt="Edit"></a>
                    <a href="#" onclick="confirmDeletion('{{ url('delete/' . $post->id) }}')">
                        <img class="delete_icon" src="images/trash.png" alt="Delete">
                    </a>
                </div>
            @endif
            <div id="confirmationModal" class="modal">
                <div class="modal_delete">
                    <p>この投稿を削除します。よろしいでしょうか？</p>
                    <div class="button_container">
                        <button id="confirmDeleteButton">OK</button>
                        <button id="cancelButton">キャンセル</button>
                    </div>
                </div>
            </div>
            <div id="editModal{{ $post->id }}" class="modal_container">
                <div class="modal_body">
                    {!! Form::open(['url' => '/edit', 'method' => 'post']) !!}
                        <div class="modal_content">
                            {!! Form::hidden('post_id', $post->id) !!}
                            {!! Form::textarea('content', $post->post, ['class' => 'form_modal', 'rows' => 6, 'placeholder' => '投稿内容を入力してください。']) !!}
                            {!! Form::button('<img class="modal_img" src="images/edit.png" alt="Save changes">', ['type' => 'submit', 'class' => 'image_button','style' => 'border: none; background: none;']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
