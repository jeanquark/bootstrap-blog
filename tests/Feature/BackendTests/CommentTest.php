<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Comment;

class AdminCommentTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Display all comments test
     *
     * @return void
     */
    public function testIndexComment()
    {
        $this->login();

        $this->visit('/admin/comment')
             ->see('All the current Comments');
    }

    
    /**
     * Edit comment test
     *
     * @return void
     */
    public function testEditComment()
    {
        $comment = Comment::where('is_published', '=', 1)->firstOrFail();

        $this->login();

        $this->visit('/admin/comment/' . $comment->id . '/edit')
             ->press('Unpublish')
             ->see('Successfully updated comment status!');

        // Check if comment has been edited
        $this->visit('/admin/comment')
             ->see('No');
    }

    /**
     * Delete comment test
     *
     * @return void
     */
    public function testDeleteComment()
    {
        $comment = Comment::firstOrFail();

        $this->login();

        $response = $this->call('DELETE', '/admin/comment/' . $comment->id, ['_token' => csrf_token()]);

        $this->visit('/admin/comment')
             ->dontSee($comment->name);
    }
}