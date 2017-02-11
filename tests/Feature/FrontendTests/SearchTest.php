<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Post;

class SearchTest extends TestCase
{
    /**
     * Search page test
     *
     * @return void
     */
    public function testSearchPage()
    {
        $post = Post::firstOrFail();
        $words = preg_split("/[\s-]+/", $post->title);
        $firstWord = $words[0];

        $this->visit('/search?search=' . $firstWord)
             ->see($post->title);
    }
}