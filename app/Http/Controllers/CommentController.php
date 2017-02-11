<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$comments = Comment::all();
        $replies = CommentReply::all();

        return View::make('admin.comment.index')
            ->with('comments', $comments)
            ->with('replies', $replies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.comment.create');
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
    	$comment = Comment::find($id);
        $post = Post::where('id', '=', $comment->post_id)->first();

        return View::make('admin.comment.edit')
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
        $comment = Comment::find($id);

       	if ($comment->is_published) {
       		$comment->is_published = false;
	    } else {
	    	$comment->is_published = true;
	    }

        $comment->published_at = Carbon::now();
	    $comment->save();

	    Session::flash('success', 'Successfully updated comment status!');
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
        $comment = Comment::findOrFail($id);

        $comment->delete();

        Session::flash('success', 'Successfully deleted comment!');
        return Redirect::to('admin/comment');
    }
}
