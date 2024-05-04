@extends('layouts.login')

@section('content')

<div class="profile_content">
    <div class="profile_flex">
        <div class="profile_img">
            <img src="{{ asset('images/'.$selectUser->images )}}" alt="User Icon" class="user_icon">
        </div>
        <div class="profile_user">
            <div class="profile_title">
                <p class="name_title">ユーザー名</p>
                <p class="bio_title">自己紹介</p>
            </div>
            <div class="profile_data">
                <p class="name_content">{{ $selectUser->username }}</p>
                <p class="bio_content">{{ $selectUser->bio }}</p>
            </div>
        </div>
        <div class="profile_follow">
            @if ($isFollowing)
                <a href="{{ url('unFollow/' . $selectUser->id. '?from=profile') }}" class="unFollow_btn"><p>フォロー解除</p></a>
            @else
                <a href="{{ url('follow/' . $selectUser->id. '?from=profile') }}" class="follow_btn"><p>フォローする</p></a>
            @endif
        </div>
    </div>
</div>
<div class="post_list">
    <div class="post_item">
        @foreach ($userWithPosts as $post)
            <div class="post_flex">
                <div class="user_img">
                    <img src="{{ asset('images/'.$selectUser->images )}}" alt="User Icon" class="user_icon">
                </div>
                <div class="post_text">
                    <span class="username">{{ $selectUser->username }}</span>
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
