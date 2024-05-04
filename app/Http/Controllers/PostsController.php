<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $user   = Auth::user();
            $userId = Auth::id();

            $followingIds = Follow::where('following_id', $userId)
                                    ->distinct()
                                    ->pluck('followed_id');

            $followingIds[] = $userId;
            $posts = Post::whereIn('user_id', $followingIds)
                            ->with('user')
                            ->orderBy('created_at', 'desc')
                            ->get();

            $followingsCount = $user->followingsCount();
            $followersCount  = $user->followersCount();

            return view('posts.index', ['user' => $user,'posts' => $posts,'followingsCount' => $followingsCount,'followersCount' => $followersCount]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'データの取得中にエラーが発生しました。'])->withInput();
        }
    }

    public function post(Request $request)
    {
        $request->validate([
            'content' => 'required|min:1|max:150',
        ]);
        try {
            $user = Auth::user();
            $post = $request->input('content');
            Post::create(['user_id' => $user->id,'post' => $post]);
            return redirect('/top');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '投稿中にエラーが発生しました。']);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|min:1|max:150',
        ]);
        try {
            $post_id = $request->input('post_id');
            $post    = $request->input('content');

            Post::where('id', $post_id)->update(['post' => $post]);
            return redirect('/top');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '投稿の更新中にエラーが発生しました。'])->withInput();
        }
    }

    public function delete($id)
    {
        try {
            Post::where('id', $id)->delete();
            return redirect('/top');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => '投稿の削除中にエラーが発生しました。'])->withInput();
        }
    }
}
?>
