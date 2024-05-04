<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="AtlasSNS" />

    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div id = "head">
            <h1><a href="/top"><img class="atlas_logo" src="{{ asset('images/atlas.png') }}"></a></h1>
            <div id="headContent">
                <div id="headName">
                    <p>{{ $user->username }}<span>さん</span></p>
                </div>
                <div class="accordion">
                    <div class="accordion_header">
                        <i class="fa-solid fa-chevron-down arrow"></i>
                    </div>
                </div>
                <img src="{{ asset('images/' .$user->images)}}" alt="User Icon">
            </div>
        </div>
    </header>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="sideBar">
            <ul class="accordion_content">
                <li><a href="/top">HOME</a></li>
                <li><a href="{{ url('profile/') }}">プロフィール編集</a></li>
                <li><a href="/logout">ログアウト</a></li>
            </ul>
            <div id="confirm">
                <p>{{ $user->username }}さんの</p>
                <div class="followCount">
                    <p class="followCount_text">フォロー数</p>
                    <p>{{ $followingsCount }}人</p>
                </div>
                <div class="button">
                    <p><a class="followList_btn" href="{{ url('follow-list/') }}">フォローリスト</a></p>
                </div>
                <div class="followCount">
                    <p class="followCount_text">フォロワー数</p>
                    <p>{{ $followersCount }}人</p>
                </div>
                <div class="button">
                    <p><a class="followerList_btn" href="{{ url('follower-list/') }}">フォロワーリスト</a></p>
                </div>
            </div>
            <div class="search_btn">
                <p><a href="/search">ユーザー検索</a></p>
            </div>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
