<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Tag;
use App\Post;

class AdminTagTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Display all tags test
     *
     * @return void
     */
    public function testIndexTag()
    {
        $this->login();

        $this->visit('/admin/tag')
             ->see('All the current Tags');
    }

    /**
     * Create tag test
     *
     * @return void
     */
    public function testCreateTag()
    {
        $this->login();

        $this->visit('/admin/tag')
             ->click('Create a Tag')
             ->see('Create a new Tag')
             ->type('New Slug', 'name')
             ->type('new-slug', 'slug')
             ->type('#8c8c8c', 'color')
             ->press('Create Tag')
             ->see('New Tag created!');
    }

    /**
     * Edit tag test
     *
     * @return void
     */
    public function testEditTag()
    {
        $tag = Tag::firstOrFail();

        $this->login();

        $this->visit('/admin/tag/' . $tag->id . '/edit')
             ->see('Edit Tag')
             ->type($tag->name . ' new', 'name')
             ->type($tag->slug . '-new', 'slug')
             ->type('#ff0000', 'color')
             ->press('Edit Tag')
             ->see('Successfully updated tag!');

        // Check if post has been edited
        $this->visit('/admin/tag')
             ->see($tag->name . ' new');
    }

    /**
     * Delete tag test
     *
     * @return void
     */
    public function testDeleteTag()
    {
        $post = Post::firstOrFail();
        $tag = $post->tags()->firstOrFail();

        $this->login();

        $response = $this->call('DELETE', '/admin/tag/' . $tag->id, ['_token' => csrf_token()]);

        $this->visit('/admin/tag')
             ->dontSee($tag->name);

        //Verify that the deleted tag is removed from post
        $this->visit('/post/' . $post->slug)
             ->dontSee($tag->name . '</span>');
    }
}