<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_login_page()
    {
       $this->get("login")->assertSeeText("Login");
    }
    
    public function test_login_sukses()
    {
       $this->post('/login',[
            "user" =>  "ramdan",
            "password" => "only"
       ])->assertRedirect("/")
            ->assertSessionHas("user", "ramdan");
    }
 
    public function test_login_validation_error()
    {
       $this->post('/login',[])
            ->assertSeeText("User or Password is required");    
    }
    
    public function test_login_failed()
    {
       $this->post('/login',[
            "user" => "ramdan",
            "password" => "salah"
       ])->assertSeeText("User or Password Wrong!");    
    }

    public function test_logout()
    {
        $this->withSession([
            "user" => "ramdan"
        ])->post('/logout')
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }

    public function test_logout_guset()
    {
        $this->post('/logout')
            ->assertRedirect("/");
    }
}

