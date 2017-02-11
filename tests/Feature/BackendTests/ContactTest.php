<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Contact;

class AdminContactTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Display all contacts test
     *
     * @return void
     */
    public function testIndexContact()
    {
        $this->login();

        $this->visit('/admin/contact')
             ->see('All the current Contacts');
    }

    /**
     * Show contact test
     *
     * @return void
     */
    public function testShowContact()
    {
        $contact = Contact::firstOrFail();

        $this->login();

        $this->visit('/admin/contact/' . $contact->id)
            ->see($contact->name);
    }


    /**
     * Delete contact test
     *
     * @return void
     */
    public function testDeleteContact()
    {
        $contact = Contact::firstOrFail();

        $this->login();

        $response = $this->call('DELETE', '/admin/contact/' . $contact->id, ['_token' => csrf_token()]);

        $this->visit('/admin/contact')
             ->dontSee($contact->name);
    }
}