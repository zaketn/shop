<?php

namespace App\Services\Telegram;

use App\Services\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;
use Throwable;

class TelegramBotApi
{
    private const URL = 'https://api.telegram.org/bot';

    public static function sendMessage(string $botToken, string $chatId, string $message): bool
    {
        try{
            $response = Http::get(self::URL . "$botToken/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'html'
            ])
                ->throw()
                ->json();

            return $response['ok'] ?? false;
        } catch (Throwable $e) {
            report(new TelegramBotApiException($e->getMessage()));

            return false;
        }
    }
}
