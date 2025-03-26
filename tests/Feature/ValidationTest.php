<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use DatabaseMigrations;

    public function test_listing_validation()
    {
        $response = $this->post('/listings', [
            'title' => '',
            'description' => '',
            'price' => -10,
        ]);

        $response->assertSessionHasErrors(['title', 'description', 'price']);
    }
}
