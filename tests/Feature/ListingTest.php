<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Listing;
use App\Models\User;

class ListingTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_can_create_listing()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/listings', [
            'title' => 'Test Listing',
            'description' => 'Test Description',
            'price' => 100,
        ]);

        $response->assertRedirect('/listings');
        $this->assertDatabaseHas('listings', [
            'title' => 'Test Listing',
        ]);
    }

    public function test_user_can_update_listing()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/listings/' . $listing->id, [
            'title' => 'Updated Listing',
            'description' => 'Updated Description',
            'price' => 200,
        ]);

        $response->assertRedirect('/listings/' . $listing->id);
        $this->assertDatabaseHas('listings', [
            'id' => $listing->id,
            'title' => 'Updated Listing',
        ]);
    }

    public function test_user_can_delete_listing()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete('/listings/' . $listing->id);

        $response->assertRedirect('/listings');
        $this->assertDatabaseMissing('listings', [
            'id' => $listing->id,
        ]);
    }
}
