<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function index()
    {
        return auth()->user()->unreadNotifications;
    }

    public function read(Request $request)
    {
        $this->validate($request, ['id' => 'required|string|uuid']);
        $notification = auth()->user()->notifications()->find($request->input('id'));
        $notification->markAsRead();
        return response()->json(['status' => 'ok']);
    }

    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['status' => 'ok']);
    }
}
