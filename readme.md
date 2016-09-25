# Demo

App test, Instalation Process

Do you have pre-installed:
    github
    composer

1. Create repository
    -> cd /var/html
    -> git clone https://github.com/freddiegar/demo.git

2. Install dependencies
    -> cd demo
    -> composer install

3. Set config environment
    -> mv .env.example .env

4. Create key for app
    -> php artisan key:generate

5. Create database within tables (this app use MySQL)
    -> create database demo
    -> php artisan migrate

6. Seed tables with pre-inserts
    -> php artisan db:seed

7. Seed table banks, this process is schedule task, is necesary that you enabled crontab
    * * * * * php /var/html/demo/php artisan schedule:run >> /dev/null 2>&1


8. Ready, You execute
    -> php artisan serve


9. That is all, go to: http://localhost:8000

Enjoy!

This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
