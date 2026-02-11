<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public $name = 'Bob';
    public $age = '20';
    public $hobby = 'swim';

    public function setName($name){
        $this->name = $name;
    }

    public function setHobby($hobby){
        $this->hobby = $hobby;
    }

    public function getName(){
        return $this->name;
    }

    // Новый метод для получения данных из таблицы users
    public function getUsers(Request $request)
    {
        $users = User::all(); // Извлекаем всех пользователей из таблицы users
        return response()->json($users); // Возвращаем данные в формате JSON
    }
}

