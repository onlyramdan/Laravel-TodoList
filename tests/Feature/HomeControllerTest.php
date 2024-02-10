<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    
    public function test_guest()
    {
        $this->get("/")
            ->assertRedirect("/login");
    }

    public function test_member()
    {
        $this->withSession([
            "user" => "ramdan",
            "password" => "only"
        ])
            ->get("/")
            ->assertRedirect("/todolist");
    }

}
