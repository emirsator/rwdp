# RWDP
Rapid Web Development Platform powered by Laravel.

## Idea
Many times we want to develop something really fast. Usually the core is always more or less the same. You have some login, user management, logs, routing etc.
When you start with laravel, you will have most of those things out of the box. However, you will still have to do some work in order to have some basic skeleton. 
After developing few projects with Laravel I have decided to extract basic functionalities, and to power them with few additional things that can boost us even more.

## Realisation
By just forking the repo you will have:
1. Laravel 5.4
2. Login UI
3. User management UI and backend (users and roles)
4. Logs into database
5. Grid helper
6. Few additional helper files to help you separate business logic

## Additional
RWDP also contains https://github.com/emirsator/Laravel-5-Artisan-Generators which brings you additional artisan command to help you include new business entities even faster.

## Installation
```
git clone https://github.com/emirsator/rwdp
composer update
npm install
php artisan migrate
php artisan db:seed
```

### Add new entity
1. Create laravel migration
```
php artisan make:migration <Entity_Name>
php artisan make:entity <Entity_Name>
```
2. Done! :)
You will have migration for DB changes, repository, service, contoller, views, languages, routes, etc...
All with implemented basic CRUD operations.


From developer to developers.
