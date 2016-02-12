<?php

use Illuminate\Database\Seeder;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert([
            'title' => 'GetDown README.md',
            'description' => 'GetDown - A Laravel-based Markdown manager',
            'content' => '
# GetDown - A Laravel-based Markdown manager

This is a simple Markdown manager written in Laravel and using Boostrap. Its more a proof-of-concept and not really ready for production... yet.

## Requirements

* Suitable server (LAMP-based)
* A MySQL database for use with Bookmarks (utf8 should be fine)
* Bower (and thus Node/NPM)

## Up and Running
Create your MySQL database and clone this repo into a new vhost/web dir.

Run composer\'s install option to grab everything for Laravel:
```
composer install
```
Run bower\'s install option to grab all of the required .js/.css (public/assets/vendor):
```
bower install
```
Copy over .env.example so you have your own preferences file:
```
cp .env.example .env
```
Edit it and modify the last 4 lines:
```
nano .env
```
```
DB_HOST=localhost
DB_DATABASE=getdown
DB_USERNAME=user
DB_PASSWORD=password
```
Run Laravel/artisan to generate a new app key:
```
php artisan key:generate
```
Run the migrations and database seeders to get you up and running:
```
php artisan migrate
```
```
php artisan db:seed
```
Set permissions appropriately
```
chmod -R 777 /my/getdown/webroot
```
Default user/password is: admin@localhost/password

## New Document

![New Document](https://raw.githubusercontent.com/jjcosgrove/laravel-getdown/master/grabs/new-document.png)

## Template Listing

![Template Listing](https://raw.githubusercontent.com/jjcosgrove/laravel-getdown/master/grabs/templates.png)

## Document Listing

![Document Listing](https://raw.githubusercontent.com/jjcosgrove/laravel-getdown/master/grabs/documents.png)

## Fullscreen Mode

![Fullscreen Mode](https://raw.githubusercontent.com/jjcosgrove/laravel-getdown/master/grabs/fullscreen.png)

## Features
* Basic accounts
* Templates/New from template
* Live edit/preview of Markdown
* Syntax highlighting
* Fullscreen mode

## Todo
* Tidy up/refactor
* Fully searchable documents
* Tag support
* Lots more

## Notes
There is already a .htaccess in the root to rewrite to /public
            ',
            'user_id' => 1
        ]);
    }
}
