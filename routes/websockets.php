<?php

use Illuminate\Support\Facades\Broadcast;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

Broadcast::channel('websocket-channel', function () {
    return true;
});

WebSocketsRouter::webSocket('/api/socket', \App\Http\Controllers\WebSocketController::class);
