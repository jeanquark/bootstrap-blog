<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * Home page test
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->visit('/')
             ->see('Page Heading')
             ->click('Home')
             ->see('Page Heading');
    }
}