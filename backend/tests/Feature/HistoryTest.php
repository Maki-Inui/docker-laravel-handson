<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HistoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHistoryIndex()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(action('App\Http\Controllers\HistoriesController@index', $user->id));
        $response->assertStatus(200)->assertViewIs('history.index');
    }
}
