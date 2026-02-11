<?php

namespace App\Http\Controllers;

use App\Models\Event;

class DubleController extends Controller
{
    public function index()
    {
        $event = Event::where('id', 70)->first();
        $user = $event->user;

        $test = new TestController();
        echo $test ->getName();
        echo $test->name;
        echo $test->age;
        echo $test->hobby;
    }
}
