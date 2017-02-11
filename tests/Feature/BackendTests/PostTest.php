<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Post;

class AdminPostTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Display all posts test
     *
     * @return void
     */
    public function testIndexPost()
    {
        $this->login();

        $this->visit('/admin/post')
             ->see('All the current Posts');
    }

    /**
     * Show post test
     *
     * @return void
     */
    public function testShowPost()
    {
        $post = Post::firstOrFail();

        $this->login();

        $this->visit('/admin/post/' . $post->id)
            ->see($post->title);
    }

    /**
     * Create post test
     *
     * @return void
     */
    public function testCreatePost()
    {
        $this->login();

        $this->visit('/admin/post')
             ->click('Create a Post')
             ->see('Create a new Post')
             ->type('New Post', 'title')
             ->type('new-post', 'slug')
             ->type([1,2], 'tags')
             ->type('Some text', 'text')
             ->press('Create Post')
             ->see('New Post created!');
    }

    /**
     * Edit post test
     *
     * @return void
     */
    public function testEditPost()
    {
        $post = Post::firstOrFail();

        $this->login();

        $this->visit('/admin/post/' . $post->id . '/edit')
             ->see('Edit Post')
             ->type($post->title . ' new', 'title')
             ->type($post->slug . '-new', 'slug')
             ->press('Edit the Post')
             ->see('Successfully updated post!');

        // Check if post has been edited
        $this->visit('/admin/post/' . $post->id)
             ->see($post->title . ' new');
    }

    /**
     * Delete post test
     *
     * @return void
     */
    public function testDeletePost()
    {
        $post = Post::firstOrFail();

        $this->login();

        $response = $this->call('DELETE', '/admin/post/' . $post->id, ['_token' => csrf_token()]);

        $this->visit('/admin/post')
             ->dontSee($post->title);
    }
}