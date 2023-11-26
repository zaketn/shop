<?php
namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class TelegramLoggerHandler extends AbstractProcessingHandler
{
    private string $telegramApiKey;
    private string $chatId;

    public function __construct(array $config)
    {
        $this->telegramApiKey = $config['chat_id'];
        $this->chatId = $config['telegram_bot_api_key'];

        $level = Logger::toMonologLevel($config['level']);
        parent::__construct($level);
    }

    protected function write(LogRecord $record): void
    {
        TelegramBotApi::sendMessage($this->telegramApiKey, $this->chatId, $record->formatted);
    }
}
