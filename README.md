# onix-laravel-internship
### Інструменти для запуску проєкту
Для того, щоб запустити проєкт, вам знадобиться:
1. Composer >= **2.3.7**
2. Docker >= **20.10.18**
3. Docker Compose >= **1.29.2**

### Як запустити проєкт?
Для того, щоб запустити проєкт, вам потрібно:
1. Клонувати репозиторій:

   `git clone https://github.com/shavlenkov/onix-laravel-internship.git`
2. З файлу .env.example зробити файл .env
3. Внести необхідні зміни конфігурації до файлу .env:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
4. Перейти до папки onix-laravel-internship: 

    `cd onix-laravel-internship`
5. Встановити всі залежності за допомогою Composer:

    `composer install`
6. Запустити контейнери за допомогою Docker Compose:

   `docker-compose up -d`
7. Підключитися до контейнера:

   `docker exec -it onix-laravel-internship_laravel.test_1 bash`
   1. Згенерувати App Key:
   
      `php artisan key:generate`
   2. Запустити міграції:
   
      `php artisan migrate`
   3. Створити Symbolic Link:
   
      `php artisan storage:link`
