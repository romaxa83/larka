<?php

namespace App\tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use Tests\TestCase;
use Tests\Traits\JsonStructure;

class LoginTest extends TestCase
{
    use DatabaseTransactions, JsonStructure;

    /** @test */
    public function success()
    {
        $user = factory(User::class)->create();

        $response = $this->postJson(route('api.login'), [
            'login' => $user->name,
            'password' => 'password'
        ])->dump();

        $response
            ->assertStatus(Response::HTTP_OK);

//        $content = json_decode($responseFirst->getContent());
//
//        $this->assertTrue($content->data->success);
//        $this->assertNotEmpty($content->data->data);
//
//        $userSecretStr = $content->data->data;
//        $dataCache = Cache::get("user_{$userSecretStr}");
//
//        $this->assertEquals(implode(',', $data->get('first')), implode(',', $dataCache));
//
//        // проверяем второй шаг
//
//        $secondData = $data->get('second');
//        $secondData['user_id'] = $userSecretStr;
//
//        $responseSecond = $this->postJson(route('api.register.second.step'), $secondData);
//
//        $responseSecond
//            ->assertStatus(Response::HTTP_OK)
//            ->assertSuccessful()
//            ->assertJsonStructure($this->structureBearer());
//
//        $user = (new UserRepository())->getUserByLogin($secondData['login']);
//
//        $this->assertEquals($user->email, $secondData['email']);
//        $this->assertEquals($user->phone, $secondData['phone']);
//        $this->assertTrue(password_verify($secondData['password'], $user->password));
    }

}
