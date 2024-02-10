<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    
    private TodolistService $todolistService;
   protected function setUp():void
    {
        parent::setUp();
        
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function test_TodolistService()
    {
         self::assertNotNull($this->todolistService); 
    }

    public function test_saveTodo()
    {
        $this->todolistService->saveTodo("1", "belajar laravel");

        $todolist = Session::get("todolist");
        foreach ($todolist as $data){
            self::assertEquals("1", $data["id"]);
            self::assertEquals("belajar laravel", $data["todo"]);
        }
    }
    public function test_nullTodo(){
        self::assertEquals([],$this->todolistService->allTodo());
    }
    
    public function test__not_nullTodo(){
        $ekspetasi = [
            [
                "id" => "1",
                "todo" => "belajar laravel"
            ],
            [
                "id" => "2",
                "todo" => "belajar iot"
            ]
        ];

        $this->todolistService->saveTodo("1", "belajar laravel");
        $this->todolistService->saveTodo("2", "belajar iot");

        self::assertEquals($ekspetasi,$this->todolistService->allTodo());
    }

    public function test_hapusTodo(){
        $this->todolistService->saveTodo("1", "belajar laravel");
        $this->todolistService->saveTodo("2", "belajar iot");
        
        self::assertEquals(2, sizeof($this->todolistService->allTodo()));
        
        $this->todolistService->removeTodo("1");
        
        self::assertEquals(1, sizeof($this->todolistService->allTodo()));      
        
        $this->todolistService->removeTodo("2");
        
        self::assertEquals(0, sizeof($this->todolistService->allTodo()));  
        
        self::assertEquals([],$this->todolistService->allTodo());
        
    }
}
