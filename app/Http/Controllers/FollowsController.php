<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Follow;
use App\Post;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function followList()
    {
        try{
            $user = Auth::user();
            $userId = Auth::id();

            $followingIds = Follow::where('following_id', $userId)
                                    ->distinct()
                                    ->pluck('followed_id');

            $users = User::whereIn('id', $followingIds)->get();

            $usersWithPosts = Post::whereIn('user_id', $followingIds)
                                    ->with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->get();

            $followingsCount = $user->followingsCount();
            $followersCount  = $user->followersCount();

            return view('follows.followList', ['user' => $user,'users' => $users,'usersWithPosts' => $usersWithPosts,'followingsCount' => $followingsCount,'followersCount' => $followersCount]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'フォローリストの取得中にエラーが発生しました。'])->withInput();
        }
    }

    public function followerList()
    {
        try {
            $user   = Auth::user();
            $userId = Auth::id();

            $followersIds = Follow::where('followed_id', $userId)
                            ->distinct()
                            ->pluck('following_id');

            $users = User::whereIn('id', $followersIds)->get();

            $usersWithPosts = Post::whereIn('user_id', $followersIds)
                                    ->with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->get();

            $followingsCount = $user->followingsCount();
            $followersCount  = $user->followersCount();

            return view('follows.followerList', ['user' => $user,'users' => $users,'usersWithPosts' => $usersWithPosts,'followingsCount' => $followingsCount,'followersCount' => $followersCount]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'フォロワーリストの取得中にエラーが発生しました。'])->withInput();
        }
    }
}
