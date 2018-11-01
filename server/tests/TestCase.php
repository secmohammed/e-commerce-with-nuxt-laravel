<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Contracts\JWTSubject;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;
    public function jsonAs(JWTSubject $user , $method , $endpoint , $data = [] , $headers = [])
    {
        $token = auth()->tokenById($user->id);
        return $this->json($method,$endpoint,$data,array_merge($headers,[
            'Authorization' => 'Bearer ' . $token
        ]));
    }
    public function assertJsonValidationMessages($response,$keys)
    {
        $errors = $response->json()['errors'];

        foreach (Arr::wrap($keys) as $key => $message) {
            $this->assertEquals($message , $errors[$key][0]);
        }

        return $this;
    }

}
