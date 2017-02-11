<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Post;
use App\User;
use Hashids\Hashids;

class UserTest extends TestCase
{
    /**
     * User page test
     *
     * @return void
     */
    public function testUserPage()
    {
        $post = Post::firstOrFail();
        $user = User::where('id', '=', $post->id)->firstOrFail();

        $hashids = new Hashids();
        $id = $hashids->encode($user->id);

        $this->visit('/user/' . $id)
             ->see($user->name);
    }
}