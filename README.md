
# Recommendor {PHP Laravel Engineer Position at Bayt Assignment}

A Recommendation System that utilizes post keywords from user ratings and likes to generate more posts recommendations for the user -unit tests are included-

Laravel design patterns:

1- Repository pattern

2- Service pattern

3- Observer pattern

Front-end: 

1- Laravel breeze with blade for users panel

2- Backpack for Laravel for admin panel

Back-end: 

1- Laravel 10

2- MySQL



## Build using docker and Laravel sail

If you want to run the project using sail run:

```bash
  composer install
  alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
  sail up -d
  sail artisan storage:link
  sail artisan migrate:fresh --seed
```

And you are ready to go.

## Build localy

If you want to run the project localy first make sure to make .env and copy .env.example to it:

```bash
  cp .env.example .env
```

Change Database configration

Then run:

```bash
  composer install
  php artisan storage:link
  php artisan key:generate
  php artisan migrate:fresh --seed
```

And you are ready to go.

## Admin Credintials

access admin panel on /admin 

email: admin@app.com

password: admin1234

## User Credintials

Go to /register and create your own user
