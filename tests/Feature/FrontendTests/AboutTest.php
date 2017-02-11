<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AboutTest extends TestCase
{
    /**
     * About page test
     *
     * @return void
     */
    public function testAboutPage()
    {
        $this->visit('/about')
             ->see('About me');
    }
}