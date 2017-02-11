<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Post;

class CommentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Comment test
     *
     * @return void
     */
    public function testComment()
    {
        $post = Post::firstOrFail();

        $this->visit('/post/' . $post->slug)
             ->type('Name', 'comment_name')
             ->type('Message', 'comment_text')
             ->press('Submit comment')
             ->see('Thank you. Your comment has been sent and will be published once accepted.');
    }
}