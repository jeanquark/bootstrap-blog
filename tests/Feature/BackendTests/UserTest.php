<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class AdminUserTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Display all users test
     *
     * @return void
     */
    public function testIndexUser()
    {
        $this->login();

        $this->visit('/admin/user')
             ->see('All the current Users');
    }

    /**
     * Show user test
     *
     * @return void
     */
    public function testShowUser()
    {
        $user = User::firstOrFail();

        $this->login();

        $this->visit('/admin/user/' . $user->id)
             ->see($user->name);
    }

    /**
     * Create user test
     *
     * @return void
     */
    public function testCreateUser()
    {
        $this->login();

        $this->visit('/admin/user')
             ->click('Create a User')
             ->see('Create a new User')
             ->type('Henry', 'name')
             ->type('henry@example.com', 'email')
             ->type('secret', 'password')
             ->type('secret', 'password_confirmation')
             ->press('Create User')
             ->see('New User created!');
    }

    /**
     * Edit user test
     *
     * @return void
     */
    public function testEditUser()
    {
        $user = User::firstOrFail();

        $this->login();

        $this->visit('/admin/user/' . $user->id . '/edit')
             ->see('Edit User')
             ->type($user->name . ' new', 'name')
             ->press('Edit User')
             ->see('Successfully updated user!');

        // Check if post has been edited
        $this->visit('/admin/user/' . $user->id)
             ->see($user->name . ' new');
    }

    /**
     * Delete user test
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $user = User::firstOrFail();

        $this->login();

        $response = $this->call('DELETE', '/admin/user/' . $user->id, ['_token' => csrf_token()]);

        $this->visit('/admin/user')
             ->dontSee($user->name);
    }
}