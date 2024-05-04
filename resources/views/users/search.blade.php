@extends('layouts.login')

@section('content')
{!! Form::open(['url' => '/search']) !!}
<div class="search_content">
    <div class="search_form">
        {!! Form::text('username',null,['class' => 'search_control','placeholder' => 'ユーザー名']) !!}
    </div>
    <div class="search_icon">
        <input type="image" src="images/search.png" alt="Search" />
    </div>
    <div class="search_keyword">
        @if (!empty($keyword))
            <span>検索ワード：{{ $keyword }}</span>
        @endif
    </div>
</div>
{!! Form::close() !!}

<div class="search_list">
    @foreach ($searches as $search)
        <div class="search_flex">
            <div class="search_user">
                <img src="images/{{ $search->images }}" alt="User Icon" class="user_icon">
                <span class="username">{{ $search->username }}</span>
            </div>
            <div class="search_follow">
                @if ($search->followings && $search->followings->contains('following_id', $user->id))
                    <a href="{{ url('unFollow/' . $search->id. '?from=search') }}" class="unFollow_btn"><p>フォロー解除</p></a>
                @else
                    <a href="{{ url('follow/' . $search->id. '?from=search') }}" class="follow_btn"><p>フォローする</p></a>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
