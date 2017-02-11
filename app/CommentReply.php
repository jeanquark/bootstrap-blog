<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $dates = ['published_at'];

	protected $table = 'comment_replies';

    protected $fillable = [
        'comment_id', 'name', 'message', 'published_at'
    ];

    /**
     * One to Many relation
     */
    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
