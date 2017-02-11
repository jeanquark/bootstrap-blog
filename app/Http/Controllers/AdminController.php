<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentReply;
use App\Comment;
use App\Contact;
use App\Post;
use App\User;
use App\Tag;

use Validator;
use View;

class AdminController extends Controller
{
    /**
     * Backend homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::where('is_published', '=', 0)->get();
        $comments = Comment::where('is_published', '=', 0)->get();
        $replies = CommentReply::where('is_published', '=', 0)->get();
        $contacts = Contact::where('is_read', '=', 0)->get();

        return View::make('admin.index')
            ->with('posts', $posts)
            ->with('comments', $comments)
            ->with('replies', $replies)
            ->with('contacts', $contacts);
    }
}