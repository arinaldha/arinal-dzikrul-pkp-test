<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecognitionController extends Controller
{
    public function index()
    {
        return view('recognition');
    }

    public function recognize(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recognizedData = [
            'name' => 'Arinal Dzikrul',
            'confidence' => 'High'
        ];

        return response()->json($recognizedData);
    }
}
