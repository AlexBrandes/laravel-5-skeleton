##Laravel 5 Skeleton App
This is a basic Laravel 5 App starter kit setup so that you can get to developing right away. It includes the the following ready to go: 

1. User roles and permissions
2. Sass processing and concatenating (gulp)
3. JS concatenation (gulp)
4. Bower
5. Bootstrap 3, jQuery, jQuery UI, and fontawesome 
6. Basic front end and admin layouts

That's it! Nothing you don't need or wouldn't use in nearly every project, just a a clean structure so you can get to building right away.

This starter kit is mostly for myself to use as needed but if anyone else finds it useful, please feel free to use and improve on it. 

##Installation
Make sure you have [composer](https://getcomposer.org/doc/00-intro.md) installed globally and then run the commands below. 
```bash
git clone https://github.com/AlexBrandes/laravel-5-skeleton.git myproject;
cd myproject;
sudo composer install;
php artisan key:generate;
```

##Database Setup
The app comes configured to communicate with a local mysql database called laravel using un: local and no password. You can change this easily by editing config/database.php

It also comes ready to use redis out of the box. The app is setup to use redis defaults on localhost. Here's a [quick overview](http://redis.io/topics/quickstart) of Redis installation. The most basic way is shown below.

#####On OSX:
```bash
brew install redis-server; 
redis-server;
```
#####On Ubuntu:
```bash
apt-get install redis-server;
redis-server;
```

##Migration and Seeding
Now that the database is setup we're ready to create out tables using migrations. 
```bash
php artisan migrate;
php artisan db:seed;
```

Check out the seeder classes in database/seeds for more information about the test users and roles that are set up. You'll have 3 initial roles available (user, admin, super_admin) and default users set for each so that you can log in using email: <role>@example.com and pw:<role>. For example, to log in as admin use email: admin@example.com and pw: admin.

##Assets
Install the default assets using bower.
```bash
bower install;
gulp;
```
The app is set up with Sass and js in logical groupings and then concatenated by gulp. Sass files are in resources/sass and included in the app.scss file. Gulp will process these files into the public/build/css directory and then the versioned css file is included in the app layout. JS in resources/js is also concatenated and moved to public/build/js and a versioned app.js is included in the app layout. 

##App Directory
I've left everything as is in the app directory with the exception of a few things. I've moved all models into app/db to keep them logically separated from the rest of the app code. I've also added a "CheckPermissions" middleware file that allows you to define permissions requirements at the route level. Just include permissions in the middleware key of the route and add a permissions key with an array of required permissions.

##License
Consider this beerware. Share with anyone that might find it useful and if you like it, buy me a beer if we ever happen to meet in person. Laravel is under an MIT license so please respect that. 

Enjoy!
