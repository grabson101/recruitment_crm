## About

Simple CRUD app for recruitment task [Task](https://github.com/clean-commit/laravel-developer-recruitment-task):

Installation
1. composer install
2. npm install && npm run dev
3. php artisan migrate
4. php artisan passport:install   (for api tokens)
5. php artisan db:seed --class=AdminSeeder (creates admin account _admin@admin.com_ _password_)
6. php artisan db:seed (seed database with Companies and Employees)

For local tests

- php artisan test

Note:
I know I could use repository pattern, but thought that it would be overkill for such small project.