<?php

namespace App\Services\Telegram;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TelegramBotApi
{
    private const URL = 'https://api.telegram.org/bot';

    public static function sendMessage(string $botToken, string $chatId, string $message): Response
    {
        return Http::get(self::URL . "$botToken/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'html'
        ]);
    }
}
