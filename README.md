# Laravel Justbuy-API

## Build the project


1. Copy file *docker-compose.yml* from
```
/deploy
```
and paste it into 

```
/project/justbuy-api
```

2. Go into this directory
```
cd justbuy-api/project/justbuy-api
```
3. Set the alias
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
4. Start the project in detached mode
```
sail up -d
```
5. Update composer
```
sail composer update
```
6. Migrate your database
```
sail artisan migrate:fresh
```
7. Seed the database
```
sail artisan db:seed
```
<br>

And now you can use *Postman collection* from
```
/collection
```
to test this *API*

## Enjoy!

## Documentation & Manuals

### Project construction manuals
- **[MySQL Database building with docker-compose](https://blog.christian-schou.dk/creating-and-running-a-mysql-database-with-docker-compose/)**
- **[Setting up laravel project using docker](https://ianclemence.medium.com/setting-up-laravel-project-using-docker-step-by-step-guide-7c5720fbc2c8)**
- **[Official Laravel documentation 10.x](https://laravel.com/docs/10.x/installation)**
- **[Laravel Sail](https://laravel.com/docs/10.x/sail)**

### Project technical specifications
- **[Main project task](https://drive.google.com/file/d/1yrf9owiFWKTs9_mSJ8b3uNbMHiws2yex/view)**
- **[Reference Information](https://drive.google.com/file/d/1Z8JzIJNVQ6meGYe-ckjD_N6yE0knP9wX/view)**
