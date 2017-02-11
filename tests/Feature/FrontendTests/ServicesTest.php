<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServicesTest extends TestCase
{
    /**
     * Services page test
     *
     * @return void
     */
    public function testServicesPage()
    {
        $this->visit('/services')
             ->see('Our services');
    }
}