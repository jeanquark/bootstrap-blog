<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $dates = ['published_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'name', 'message', 'published_at'
    ];

    /**
     * One to Many relation
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * One to Many relation
     */
    public function commentReplies()
    {
        return $this->hasMany('App\CommentReply', 'comment_replies');
    }
}