<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Post;

class ArticleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Article page test
     *
     * @return void
     */
    public function testArticlePage()
    {
        $publishedPost = Post::where('is_published', '=', 1)->firstOrFail();
        $unpublishedPost = Post::where('is_published', '=', 0)->firstOrFail();

        $this->visit('/post/' . $publishedPost->slug)
             ->see($publishedPost->title);

        $this->visit('/post/' . $unpublishedPost->slug)
             ->dontSee($publishedPost->title);
    }
}