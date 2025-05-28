<?php

namespace App\Http\Controllers;


abstract class Controller
{
    public function toggle(Request $request)
{
    session(['dark_mode' => $request->dark_mode]);
    return response()->json(['success' => true]);
}

public function status()
{
    return response()->json(['dark_mode' => session('dark_mode', false)]);
}

}
