<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Post;

class ReplyTest extends DuskTestCase
{
    use DatabaseTransactions;
    /**
     * Test reply to a comment.
     *
     * @return void
     */
    public function testReply()
    {
        $post = Post::join('comments', 'posts.id', '=', 'comments.post_id')
        ->where('posts.is_published', '=', 1)
        ->where('comments.is_published', '=', 1)
        ->first();

        $this->browse(function ($browser) use ($post) {
            $browser->visit('/post/' . $post->slug)
                    ->clickLink('Reply')
                    ->type('reply_name', 'John Doe')
                    ->type('reply_text', 'I agree with this comment.')
                    ->press('Submit reply')
                    ->assertSee('Thank you. Your reply has been sent and will be published once accepted.');
        });
    }
}