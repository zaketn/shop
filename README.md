# Пет-проект: "Интернет-магазин"
- Кастомный логгер для отправки логов в телеграм
- Отслеживание проблем при продакшене и отправка информации в телеграм, при их возникновении

## Установка
### Установка через docker
`docker-compose up -d`

- Доступ к php и composer - `docker-compose exec php sh`
- Доступ к node(npm) - docker-compose run --rm node _install | run dev | update | ..._

### Запуск проекта
1. `composer install`
2. `php artisan app:install`

## .env
- TELEGRAM_BOT_API_KEY - api ключ телеграм бота
- LOGGING_CHAT_ID - chat_id для отправки логов
