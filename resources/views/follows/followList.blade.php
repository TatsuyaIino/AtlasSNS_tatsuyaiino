@extends('layouts.login')

@section('content')

<div class="follow_flex">
    <div class="follow_text">
        <p>フォローリスト</p>
    </div>
    <div class="img_grid">
        @foreach ($users as $followUser)
            <a href="{{ url('otherProfile/' . $followUser->id) }}"><img src="images/{{ $followUser->images }}" alt="User Icon" class="user_icon"></a>
        @endforeach
    </div>
</div>
<div class="post_list">
    <div class="post_item">
        @foreach ($usersWithPosts as $post)
            <div class="post_flex">
                <div class="user_img">
                    <a href="{{ url('otherProfile/' . $post->user->id) }}"><img src="images/{{ $post->user->images }}" alt="User Icon" class="user_icon"></a>
                </div>
                <div class="post_text">
                    <span class="username">{{ $post->user->username }}</span>
                    <p>{{ $post->post }}</p>
                </div>
                <div class="post_date">
                    <span class="date">{{ $post->created_at->format('Y-m-d H:i') }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
