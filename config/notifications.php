<?php

return [

    'telegram' => [
        'on' => env('TELEGRAM_NOTIFICATIONS', false),
        'chat_id' => env('TELEGRAM_CHAT_ID'),
    ]

];
