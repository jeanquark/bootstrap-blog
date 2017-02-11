<?php namespace Tests;

// use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // public $baseUrl = 'http://localhost';
    public $baseUrl = 'http://bootstrap-blog.app';

    /**
     *  Log administrator
     *
     * @return void
     */
    public function login()
    {
    	$user = factory(\App\User::class)->create();

        $this->visit('/login')
             ->type($user->email, 'email')
             ->type('secret', 'password')
             ->press('Login');
    }
}
