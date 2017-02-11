<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\CommentReply;

class AdminCommentReplyTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Display all replies test
     *
     * @return void
     */
    public function testIndexReply()
    {
        $this->login();

        $this->visit('/admin/comment')
             ->see('All the current Replies');
    }

    
    /**
     * Edit reply test
     *
     * @return void
     */
    public function testEditReply()
    {
        $reply = CommentReply::where('is_published', '=', 1)->firstOrFail();

        $this->login();

        $this->visit('/admin/reply/' . $reply->id . '/edit')
             ->press('Unpublish')
             ->see('Successfully updated reply status!');

        // Check if reply has been edited
        $this->visit('/admin/comment')
             ->see('No');
    }

    /**
     * Delete reply test
     *
     * @return void
     */
    public function testDeleteReply()
    {
        $reply = CommentReply::firstOrFail();

        $this->login();

        $response = $this->call('DELETE', '/admin/reply/' . $reply->id, ['_token' => csrf_token()]);

        $this->visit('/admin/comment')
             ->dontSee($reply->name);
    }
}