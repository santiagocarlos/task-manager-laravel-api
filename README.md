# Laravel API - Task list Manager 

This project corresponds to the coding challenge to apply for the position of Fullstack Developer at InfoCasas.

This repository contains a REST API developed in Laravel, which corresponds to a task management application.

## Pre-requisites

For the correct operation of this project, it is necessary that you have the following dependencies installed

- Apache
- PHP
- MySQL
- Composer 

### Softwares
- Postman

## Installing pre-requisites

The steps described here are for Ubuntu or Debian-derived distros

##### Install Apache 

Using Ubuntu’s package manager, `apt`:

```bash
$ sudo apt update
$ sudo apt install apache2
```
##### Install MySQL

```bash
$ sudo apt install mysql-server
```
When the installation is finished, it’s recommended that you run a security script that comes pre-installed with MySQL. This script will remove some insecure default settings and lock down access to your database system. Start the interactive script by running:

```bash
$ sudo mysql_secure_installation
```
And following the steps

##### Install PHP
```bash
$ sudo apt install php libapache2-mod-php php-mysql
```

Once the installation is finished, you can run the following command to confirm your PHP version:

```bash
$ php -v
```

```bash
Output
PHP 7.4.3 (cli) (built: Mar 26 2020 20:24:23) ( NTS )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
    with Zend OPcache v7.4.3, Copyright (c), by Zend Technologies
```

At this point, your LAMP stack is fully operational


## Installation of project

Open a terminal and clone this repository using

```bash
$ git clone https://github.com/santiagocarlos/task-manager-laravel-api
```

Change to the newly created repository folder with

```bash
$ cd task-manager-laravel-api
```

After cloning the repo, run `composer install`

Create a copy of the `.env.example` file in a new file and name it `.env` 

Create a database and preferably name it `task-manager`

Then edit the following values

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
Once composer solves the dependencies and discovers the packages, it runs the migrations and the laravel seeders to dump the database structure and its data

```bash
php artisan migrate --seed
```
To make it easier you can build the application server using

```bash
php artisan serve
```
You will normally see the following message

```bash
Starting Laravel development server: http://127.0.0.1:8000
[Mon Jul 12 08:54:45 2021] PHP 7.4.3 Development Server (http://127.0.0.1:8000) started
.
.
.
```

`http://127.0.0.1:8000` is the URL of project.

Since the project is an API, the base URL for making requests is

`http://127.0.0.1:8000/api`


#### Definition of routes

The project is treated as a REST API, therefore the routes are defined in the `/routes/api.php` file

The REST approach is used and these are the routes generated using `Route::apiResource()`


```
GET       | api/tasks   
POST      | api/tasks
PATCH     | api/tasks/checkAll
POST      | api/tasks/search
GET       | api/tasks/{task}
PUT/PATCH | api/tasks/{task} 
DELETE    | api/tasks/{task}
```

#### Postman

Inside the repository there is a file called XXXX
with a collection of calls to the endpoints, which can be imported into POSTMAN to test each of these endpoints, and to test the correct operation of the API.

## React App

The second part of the challenge, and the application that consumes the data provided by this API, can be found in the following repo Task Manager React App.