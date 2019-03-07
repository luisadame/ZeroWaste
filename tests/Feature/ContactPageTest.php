<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactPageTest extends TestCase
{
    /** @test */
    public function it_shows_the_contact_page()
    {
        $this->get(route('contact'))
            ->assertSuccessful()
            ->assertSee('Contact');
    }
}
