<?php

namespace Tests\Feature;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StockTest extends TestCase
{
    public function test_index(): void
    {
        $response = $this->get('/api/v1/stocks');

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json)=>
            $json->has(Stock::all()->count())
                ->first(fn (AssertableJson $json)=>
                $json
                    ->where('isActive',Stock::query()
                        ->orderBy('is_active')
                        ->first()
                        ->is_active)
                    ->etc())
            );
    }
    public function test_success_store():void
    {
        $response = $this->post('/api/v1/stocks',[
            'companyId'=>1,
            'isActive'=>true,
            'price'=>100
        ]);
        $response->assertOk()->assertJson(fn(AssertableJson $json)=>
        $json
            ->where('isActive',true)
            ->has('id')
            ->etc());
    }
    public function test_wrong_store():void
    {
        $response = $this->withHeaders([
            'accept'=>'application/json'
        ])->post('/api/v1/users',[
            'secret'=>"KL>FHn2l4JNHFg4ohfn",
        ]);
        $response->assertStatus(422);
        $response->assertStatus(422)
            ->assertJson(fn (AssertableJson $json)=>
            $json->has('errors.companyId')
                ->etc());
    }
    public function test_update_success()
    {
        $stock = Stock::first();
        $response = $this->withHeaders([
            'accept'=>'application/json'
        ])->put('/api/v1/stocks/' . $stock->id,[
            'isActive'=>false,
        ]);
        $response->assertOk()
            ->assertJson(fn (AssertableJson $json)=>
            $json->where('isActive',false)->etc()
            );
    }
    public function test_update_fail()
    {
        $user = Stock::first();
        $response = $this->withHeaders([
            'accept'=>'application/json'
        ])->put('/api/v1/users/' . $user->id,[
            'id'=>10,
        ]);
        $response->assertOk()->assertJson([]);
    }
}
