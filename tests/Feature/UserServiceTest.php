<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }
    public function test_sampel()
    {
        self::assertTrue(true);
    }

    public function test_sukses_login()
    {
        self::assertTrue($this->userService->login("ramdan",  "only"));
    }
    
    public function test_user_not_found()
    {
        self::assertFalse($this->userService->login("ucup",  "ucup"));
    }
    
    public function test_wrong_password()
    {
        self::assertFalse($this->userService->login("onlyramdan",  "ucup"));
    }
}
