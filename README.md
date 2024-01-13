### Process of starting application

copy .env.example into .env

Depending on what web server is used, 
you will need to configure it by yourself 
and set in hosts file alias for your local 
ip address

Backend commands
```
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve (if no webserver used)
```

Frontend commands
```
npm i
npm run dev
```

