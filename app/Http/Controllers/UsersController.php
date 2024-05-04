<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\User;
use App\Follow;
use App\Post;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try{
            $user = Auth::user();
            $currentUserId = Auth::id();

            $users = User::where('id', '!=', $currentUserId)
                        ->with('followings')
                        ->get();

            $followingsCount = $user->followingsCount();
            $followersCount  = $user->followersCount();

            return view('users.search', ['user' => $user,'searches' => $users,'followingsCount' => $followingsCount,'followersCount' => $followersCount]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'データの取得中にエラーが発生しました。']);
        }
    }

    public function follow($id, Request $request)
    {
        try {
            $currentUserId = Auth::id();

            Follow::create(['following_id' => $currentUserId,'followed_id' => $id]);
            $from = $request->query('from');

            if ($from == 'search') {
                return redirect('/search');
            } else {
                return redirect('/otherProfile/' . $id);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'フォロー操作中にエラーが発生しました。']);
        }
    }

    public function unFollow($id, Request $request)
    {
        try {
            $currentUserId = Auth::id();

            Follow::where('following_id', $currentUserId)
                    ->where('followed_id', $id)
                    ->delete();
            $from = $request->query('from');

            if ($from == 'search') {
                return redirect('/search');
            } else {
                return redirect('/otherProfile/' . $id);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'フォロー解除操作中にエラーが発生しました。']);
        }
    }

    public function profile()
    {
        try {
            $user = Auth::user();
            $currentUserId   = Auth::id();
            $followingsCount = $user->followingsCount();
            $followersCount  = $user->followersCount();

            return view('users.profile',['user' => $user,'followingsCount' => $followingsCount,'followersCount' => $followersCount]);
        } catch (\Exception $e) {
            return redirect('/home')->withErrors(['error' => 'プロファイル情報の取得中にエラーが発生しました。']);
        }
    }

    public function otherProfile($id)
    {
        try {
            $user = Auth::user();
            $currentUserId = Auth::id();

            $followingsCount = $user->followingsCount();
            $followersCount  = $user->followersCount();

            $isFollowing = Follow::where('following_id', $currentUserId)
                                ->where('followed_id', $id)
                                ->exists();

            $selectUser = User::findOrFail($id);
            $userWithPosts = $selectUser->posts()->orderBy('created_at', 'desc')->get();

            return view('users.otherProfile',['user' => $user,'selectUser' => $selectUser,'userWithPosts' => $userWithPosts,'followingsCount' => $followingsCount,'followersCount' => $followersCount,'isFollowing' => $isFollowing]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '他のプロフィール情報の取得中にエラーが発生しました。']);
        }
    }

    public function search(Request $request)
    {
        try {
            $user = Auth::user();
            $keyword = $request->input('username');

            if(!empty($keyword)){
                $users = User::where('username','like', '%'.$keyword.'%')
                                ->where('username', '!=' ,$user->username)
                                ->get();
            }else{
                $users = User::where('username', '!=' ,$user->username)->get();;
            }
            $followingsCount = $user->followingsCount();
            $followersCount  = $user->followersCount();

            return view('users.search', ['user' => $user,'searches' => $users,'keyword' => $keyword,'followingsCount' => $followingsCount,'followersCount' => $followersCount]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '検索処理中にエラーが発生しました。']);
        }
    }

    public function update(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'username' => 'required|min:2|max:12',
            'mail'     => 'required|email|min:5|max:40',Rule::unique('users')->ignore($id) ,
            'password' => 'required|alpha_num|min:8|max:20',
            'password_confirmation' => 'required|alpha_num|min:8|max:20|same:password',
            'bio'      => 'max:150',
            'images'   => 'file|mimes:jpg,jpeg,png,bmp,gif,svg',
        ]);

        try {
            $data = [
                'username' => $request->input('username'),
                'mail'     => $request->input('mail'),
                'password' => bcrypt($request->input('password')),
                'bio'      => $request->input('bio'),
            ];

            if ($request->hasFile('icon_image') && $request->file('icon_image')->isValid()) {
                $originalName = $request->file('icon_image')->getClientOriginalName();
                $timestamp = time();
                // 「年月日_時分秒」の形式に変換
                $date = date('Ymd_His', $timestamp);
                $filename = $id . '_' . $date . '_' . $originalName;
                $request->file('icon_image')->storeAs('', $filename, 'public');
                $data['images'] = $filename;
            }

            User::find($id)->update($data);
            return redirect('/top');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'プロフィールの更新中にエラーが発生しました。'])->withInput();
        }
    }
}
