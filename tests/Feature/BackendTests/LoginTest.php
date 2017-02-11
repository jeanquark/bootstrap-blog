<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Login page test
     *
     * @return void
     */
    public function testLogin()
    {
        $this->visit('/login')
             ->see('Login');
    }

    /**
     * Admin page test
     *
     * @return void
     */
    public function testAdmin()
    {
        $this->login();

        $this->visit('/admin')
             ->see('Dashboard');
    }
}