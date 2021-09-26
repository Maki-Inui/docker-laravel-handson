<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Area;

class MypageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMypageShow()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(action('App\Http\Controllers\MypagesController@show', $user->id));
        $response->assertStatus(200)->assertViewIs('mypage.show');
    }

    public function testMypageEdit()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(action('App\Http\Controllers\MypagesController@edit', $user->id));
        $response->assertStatus(200)->assertViewIs('mypage.edit');
    }

    public function testMypageUpdate()
    {
        $user = User::factory()->for(Area::factory()->state(['area_name' => '大手町']))->create();
        $this->actingAs($user);
        $response = $this->get(action('App\Http\Controllers\MypagesController@edit', $user->id));
        $area = Area::factory()->state(['area_name' => '丸の内'])->create();
        $update = ['area_id' => $area->id, 'profile' => 'こんにちは'];
        $response = $this->put(action('App\Http\Controllers\MypagesController@update', $user->id), $update);
        $this->assertDatabaseHas('users', [
            'area_id' => $area->id,
            'profile' => 'こんにちは'
        ]);
        $user2 = User::find($user->id);
        $response = $this->actingAs($user2)->get(action('App\Http\Controllers\MypagesController@show', $user2->id));
        $response->assertStatus(200)->assertViewIs('mypage.show');
        $response->assertSee('丸の内');
    }
}
