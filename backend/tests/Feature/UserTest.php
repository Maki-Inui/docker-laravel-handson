<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserIndex()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(action('App\Http\Controllers\UsersController@index'));
        $response->assertStatus(200)->assertViewIs('users.index');
    }

    public function testUserShow()
    {
        $login_user = User::factory()->state(['name' => 'Anna'])->create();
        $user = User::factory()->state(['name' => 'Mary'])->create();
        $response = $this->actingAs($login_user)->get(action('App\Http\Controllers\UsersController@show', $user->id));
        $response->assertStatus(200)->assertViewIs('users.show')->assertSee('Maryさん');
    }
}
