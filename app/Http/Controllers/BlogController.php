<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentReply;
use App\Comment;
use App\User;
use App\Post;
use App\Tag;

use Hashids\Hashids;
use Validator;
use Redirect;
use Response;
use Session;
use Input;
use View;

class BlogController extends Controller
{
    protected $rules = [
        'comment_name' => ['min:2', 'max:64', "regex:/^[a-zA-Z0-9?$@#()'!,+\-=_:.&€£*%\s]+$/"],
        'comment_text'  => ['min:2', 'max:255', "regex:/^[a-zA-Z0-9?$@#()'!,+\-=_:.&€£*%\s]+$/"],
        'reply_name' => ['min:3', 'max:64', "regex:/^[a-zA-Z0-9?$@#()'!,+\-=_:.&€£*%\s]+$/"],
        'reply_text'  => ['min:2', 'max:255', "regex:/^[a-zA-Z0-9?$@#()'!,+\-=_:.&€£*%\s]+$/"]
    ];
    /**
     * Display a listing of the resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function showPost($slug) {

        $post = Post::where('slug', '=', $slug)->first();
        $comments = Comment::where('is_published', '=', true)->where('post_id', '=', $post->id)->get();
        
        $replies = '';
        foreach ($comments as $comment) {
            $replies = CommentReply::where('is_published', '=', true)->where('comment_id', '=', $comment->id)->get();
        }

        $hashids = new Hashids();

        return View::make('post')
            ->with('post', $post)
            ->with('comments', $comments)
            ->with('replies', $replies)
            ->with('hashids', $hashids);

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function showTaggedPost($slug) {
        // dd('abc');
        $tag = Tag::where('slug', '=', $slug)->firstOrFail();

        $base_query = $tag->posts()->where('is_published', '=', true);
        $count = $base_query->count();
        $posts = $base_query->orderBy('published_at', 'desc')->simplePaginate(2);
        
        return View::make('tag')
            ->with('posts', $posts)
            ->with('count', $count)
            ->with('tag', $tag);

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function showUserPost($hash) {

        $hashids = new Hashids();
        $id = $hashids->decode($hash);

        $user = User::where('id', '=', $id)->firstOrFail();
        //$abc = $user;
        $base_query = $user->posts()->where('is_published', '=', true);
        $count = $base_query->count();
        $posts = $base_query->orderBy('published_at', 'desc')->simplePaginate(2);

        return View::make('user')
            ->with('posts', $posts)
            ->with('user', $user)
            ->with('count', $count);

    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search() {

    	$query = Input::get('search');
        $rules = array(
            'search' => 'required|alpha|min:2|max:32',
        );
        $query_array = array( 
        	'search' => $query,
        );

        $validator = Validator::make($query_array, $rules);

        if ($validator->passes()) {
        	$base_query = Post::where('title', 'LIKE', '%' . $query . '%')->orWhere('content_html', 'LIKE', '%' . $query . '%');
        	$count = $base_query->count();
        	$posts = $base_query->paginate(2);
     
        	return View::make('search', compact('posts', 'count', 'query'));
        } else {
        	return back()->withErrors($validator)->withInput();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function comment($slug) {

        $post = Post::where('slug', '=', $slug)->first();

        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return Redirect::to('post/' . $slug)
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $post = Post::where('slug', '=', $slug)->first();

            $comment = new Comment;

            $comment->post_id = $post->id;
            $comment->name = Input::get('comment_name');
            $comment->message = Input::get('comment_text');

            $comment->save();

            Session::flash('success', 'Thank you. Your comment has been sent and will be published once accepted.');
            return Redirect::back();

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply($id) {

        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $comment = Comment::where('id', '=', $id)->first();

            $reply = new CommentReply;

            $reply->comment_id = $comment->id;
            $reply->name = Input::get('reply_name');
            $reply->message = Input::get('reply_text');

            $reply->save();

            Session::flash('success', 'Thank you. Your reply has been sent and will be published once accepted.');
            return Redirect::back();
        }
    }
}