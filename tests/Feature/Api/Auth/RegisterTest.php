<?php

namespace App\tests\Feature\Api\Auth;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Tests\Data\RegisterData;
use Tests\TestCase;
use Tests\Traits\JsonStructure;

class RegisterTest extends TestCase
{
    use DatabaseTransactions, JsonStructure;

    /** @test */
    public function success()
    {
        $data = new RegisterData();

        $response = $this->postJson(route('api.register'), $data->get());

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertSuccessful()
            ->assertJsonStructure($this->structureStandart());

        $content = json_decode($response->getContent());

        $this->assertTrue($content->success);


        $user = (new UserRepository())->getUserByLogin($data['login']);

        $this->assertEquals($user->email, $data['email']);
        $this->assertTrue(password_verify($data['password'], $user->password));
    }

    /** @test */
    public function empty()
    {
        $data = (new RegisterData())->withoutData('all');

        $response = $this->postJson(route('api.register'), $data);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
