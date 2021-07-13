# Laravel API - Task list Manager 

This project corresponds to the coding challenge to apply for the position of Fullstack Developer at InfoCasas.

This repository contains a REST API developed in Laravel, which corresponds to a task management application.

## Pre-requisites

For the correct operation of this project, it is necessary that you have the following dependencies installed

- Apache
- MySQL
- PHP
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

##### Install Composer

For Installing PHP Composer

Start by updating the local repository lists by enter the following in a command line:

```bash
$ sudo apt-get update
```
Download the Composer installer, use the command:

```bash
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```
Verify Integrity of the Download
1. Visit the [Composer Public Keys](https://composer.github.io/pubkeys.html) page. Copy the Installer Signature (SHA-384).

2. Set the code shell variable:
```bash
$ COMPOSER=48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5
```

3. Run the script below to compare the official hash against the one you downloaded:

```bash
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '$COMPOSER') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```

The script will either tell you the download is verified, or that it has been corrupted. If it’s corrupted, re-download the file.

#### Install PHP Composer

1. Installing PHP Composer requires curl, unzip, and a few other utilities. Install them by entering the following:

```bash
$ sudo apt-get install curl php-cli php-mbstring git unzip
```

Install Composer as a command accessible from the whole system.

2. To install to `/usr/local/bin` enter:

```
$ sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
3. Once the installer finishes, verify the installation:

```
$ composer --version
```

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

Inside the repository there is a file called `Personal_Task_Manager.postman_collection.json`
with a collection of calls to the endpoints, which can be imported into POSTMAN to test each of these endpoints, and to test the correct operation of the API.

## React App

The second part of the challenge, and the application that consumes the data provided by this API, can be found in the following repo [Task Manager React App](https://github.com/santiagocarlos/task-manager-react).
