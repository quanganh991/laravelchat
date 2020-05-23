<?php

namespace App\Http\Controllers;
use App\Events\RedisEvent;
use App\Messages;
use Illuminate\Http\Request;
class RedisController extends Controller
{
    public function index(){
        $messages = Messages::all();
        return view('messages',compact('messages'));
    }

    public function postSendMessage(Request $request){
        $messages = Messages::create($request->all());
        event(
            $e = new RedisEvent($messages)
        );
        return redirect()->back();
    }
}
