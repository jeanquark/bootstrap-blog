<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminHomeTest extends TestCase
{
	/**
     * Admin home page test
     *
     * @return void
     */
    public function testAdminHomePage()
    {
        $this->login();

        $this->visit('/admin')
             ->see('Dashboard');
    }
}