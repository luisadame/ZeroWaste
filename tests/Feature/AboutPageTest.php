<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutPageTest extends TestCase
{
    /** @test */
    public function it_shows_the_about_page()
    {
        $this->get(route('about'))
            ->assertSuccessful()
            ->assertSee('About');
    }
}
