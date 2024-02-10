<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        if (!Session::exists("todolist")) {
            Session::put("todlist",  []);
        }
        Session::push("todolist",[
            "id" => $id,
            "todo" => $todo
        ]);
    }
    public function allTodo(): array
    { 
        return Session::get("todolist",[]);
    }

    public function removeTodo(string  $id)
    {
        $todolist = Session::get("todolist");

        foreach ($todolist as $i => $todo){
            if ($todo["id"]==$id) {
                unset($todolist[$i]);
                break;
            }
        }
        Session::put("todolist",$todolist);
    }
}