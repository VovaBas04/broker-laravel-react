<?php

namespace Tests\Feature;


use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use function Pest\Laravel\json;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/api/v1/users');

        $response->assertStatus(200)
                 ->assertJson(fn (AssertableJson $json)=>
                 $json->has(User::all()->count())
                     ->first(fn (AssertableJson $json)=>
                     $json
                         ->where('fullName',User::query()
                             ->orderBy('full_name')
                             ->first()
                             ->full_name)
                         ->etc())
                     );
    }
    public function test_success_store():void
    {
        $email = Str::random(10) . "@gmail.com";
        $response = $this->post('/api/v1/users',[
            'email'=>$email,
            'password'=>"KL>FHn2l4JNHFg4ohfn",
            'full_name'=>"Басыров Владимир Александрович",
            'money'=>125,
            'company_id'=>1
        ]);
        $response->assertOk()->assertJson(fn(AssertableJson $json)=>
            $json
                ->where('email',$email)
                ->where('money',125)
                ->etc());
    }
    public function test_two_wrong_store():void
    {
        $response = $this->withHeaders([
            'accept'=>'application/json'
        ])->post('/api/v1/users',[
            'email'=>Str::random(10) . "@gmail.com",
            'password'=>"KL>FHn2l4JNHFg4ohfn",
            'full_name'=>"Басыров Владимир Александрович",
            'money'=>125
        ]);
        $response->assertStatus(422);
        dump($response->json());
        $response = $this->withHeaders([
            'accept'=>'application/json'
        ])->post('/api/v1/users',[
            'email'=>User::query()->first()->email,
            'password'=>"KL>FHn2l4JNHFg4ohfn",
            'full_name'=>"Басыров Владимир Александрович",
            'money'=>125,
            'company_id'=>1
        ]);
        $response->assertStatus(422)
        ->assertJson(fn (AssertableJson $json)=>
        $json->has('errors')
            ->has('errors.email')
            ->etc());
    }
    public function test_update_success()
    {
        $user = User::first();
        $money = rand(1,200);
        $response = $this->withHeaders([
            'accept'=>'application/json'
        ])->put('/api/v1/users/' . $user->id,[
            'money'=>$money,
        ]);
        $response->assertOk()
        ->assertJson(fn (AssertableJson $json)=>
            $json->where('money',$money)->etc()
        );
    }
    public function test_update_fail()
    {
        $user = User::first();
        $response = $this->withHeaders([
            'accept'=>'application/json'
        ])->put('/api/v1/users/' . $user->id,[
            'password'=>"secret_my",
        ]);
        $response->assertOk()->assertJson([]);
    }
}
