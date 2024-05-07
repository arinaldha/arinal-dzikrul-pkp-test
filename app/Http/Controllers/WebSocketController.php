<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BeyondCode\LaravelWebSockets\WebSockets\WebSocketHandler;

class WebSocketController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        // Lakukan penanganan pesan di sini
        if ($payload['action'] === 'hello') {
            // Kirim balik pesan ke client
            WebSocketHandler::pushMessage('websocket-channel', ['message' => 'Hello from server']);
        }

        return response()->json(['status' => 'success']);
    }

    public function index()
    {
        return view('websocket');
    }
}
