# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



## Install

Clone repo

```
git clone https://github.com/napsterrahul/Loan_API.git
```

Install Composer


[Download Composer](https://getcomposer.org/download/)

cd Loan_API

composer update/install 

```
composer install
```

## How to setting 

Go into .env file and change Database credentials.

```
php artisan migrate
```

```
php artisan db:seed --class=UserSeeder

```
	
Generating a New Application Key
```

```


## Requirements

	PHP = ^7.4

## USER credentials
Admin
u:- admin@admin.com 
p:- 12345678

USER:-
u:- user1@admin.com
p:- 12345678

u:- user2@admin.com
p:- 12345678

u:- user3@admin.com
p:- 12345678
  


## API list
<!-- Example base_url = http://localhost:8080/Loan/public/ -->

1. base_url + api/login (GET) for login get APi_key and use for all other api for authentication
2. base_url + loan/ (GET) for user all loans
3. base_url + loan/ (POST) for create new Loan
3. base_url + approve/ (POST) for Admin Approve the Loan
3. base_url + loandetails/ (GET) for Admin/User Details of the Loan
3. base_url + repayment/ (POST) for User Schedule Payment of Loan

## FOr Extra details you can check postman collection which i sent on mail.
FOr parameters you can also check - 

https://stoplight.io/api/v1/projects/metro-services/loan-api/nodes/Loan-APi.yaml?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJodHRwczovL3N0b3BsaWdodC5pby9qd3QvY2xhaW1zIjp7IngtaGFzdXJhLWRlZmF1bHQtcm9sZSI6IndvcmtzcGFjZV91c2VyIiwieC1oYXN1cmEtYWxsb3dlZC1yb2xlcyI6WyJ3b3Jrc3BhY2VfdXNlciJdLCJ4LWhhc3VyYS11c2VyLWlkIjoiMTgyOTk2IiwieC1oYXN1cmEtdXNlci1pcC1hZGRyZXNzIjoiMTMwLjIxMS4wLjY2IiwieC1oYXN1cmEtd29ya3NwYWNlLWlkIjoiMTA2NTYxIn0sImlhdCI6MTY2Mjk4OTY5NiwiZXhwIjoxNjYyOTkwNTk2LCJpc3MiOiJzdG9wbGlnaHQiLCJzdWIiOiIvdXNlcnMvMTgyOTk2In0.2xrs2fWXknojtAsxUSNckDB029tew8Sw4uG7FBUpoV4

