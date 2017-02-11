<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Contact page test
     *
     * @return void
     */
    public function testContactPage()
    {
        $this->visit('/contact')
             ->see('Contact form');
    }

    /**
     * Submit message test
     *
     * @return void
     */
    public function testSubmitMessage()
    {
        $this->visit('/contact')
             ->type('Someone', 'name')
             ->type('someone@somewhere.com', 'email')
             ->type('A message', 'message')
             ->press('Send Message')
             ->see('Your message has been successfully sent. Thank you!');
    }
}