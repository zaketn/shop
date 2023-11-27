# Пет-проект: "Интернет-магазин"
- Кастомный логгер для отправки логов в телеграм
- Отслеживание проблем при продакшене и отправка информации в телеграм, при их возникновении

## Установка
### Установка через docker
`docker-compose up -d`

- Проект доступен по адресу localhost:8000
- Доступ к php и composer - `docker-compose exec php sh`
- Доступ к node(npm) - `docker-compose run --rm node install | run dev | update | ...`

Доступ к БД:
- Название БД - DB_DATABASE из .env
- Пользователь - DB_USERNAME из .env
- Пароль - DB_PASSWORD из .env

По адресу localhost:8080 доступен phpmyadmin

### Запуск проекта
1. `composer install`
2. `php artisan app:install`

## .env
- TELEGRAM_BOT_API_KEY - api ключ телеграм бота
- LOGGING_CHAT_ID - chat_id для отправки логов

## Вспомогательные команды
- `php artisan app:refresh`
  - Очистка базы данных
  - Удаление изображений из public
