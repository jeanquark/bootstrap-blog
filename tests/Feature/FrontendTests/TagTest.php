<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Tag;

class TagTest extends TestCase
{
    /**
     * Tag page test
     *
     * @return void
     */
    public function testTagPage()
    {
        $tag = Tag::firstOrFail();

        $this->visit('/tag/' . $tag->slug)
             ->see($tag->slug);
    }
}