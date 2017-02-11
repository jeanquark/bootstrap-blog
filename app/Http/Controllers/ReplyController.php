<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentReply;
use App\Comment;
use App\Post;

use Carbon\Carbon;
use Validator;
use Redirect;
use Session;
use Input;
use View;
use Form;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$reply = CommentReply::find($id);
        $comment = Comment::where('id', '=', $reply->comment_id)->first();
        $post = Post::where('id', '=', $comment->post_id)->first();

        return View::make('admin.reply.edit')
            ->with('reply', $reply)
            ->with('comment', $comment)
            ->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reply = CommentReply::find($id);

       	if ($reply->is_published) {
       		$reply->is_published = false;
	    } else {
	    	$reply->is_published = true;
	    }

        $reply->published_at = Carbon::now();
	    $reply->save();

	    Session::flash('success', 'Successfully updated reply status!');
	    return Redirect::to('admin/comment');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = CommentReply::findOrFail($id);

        $reply->delete();

        Session::flash('success', 'Successfully deleted reply!');
        return Redirect::to('admin/comment');
    }
}