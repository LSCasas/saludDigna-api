# SaludDigna API

An API built with Laravel for managing medical appointments, patients, addresses, and prescriptions. It includes basic authentication to protect endpoints and ensure that only authenticated users can access specific resources.

---

## Table of Contents

-   [Project Structure](#project-structure)
-   [Features](#features)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Requirements](#requirements)
-   [Learn More](#learn-more)

---

## Project Structure

```
saludDigna-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       ├── AppointmentController.php
│   │   │       ├── AddressController.php
│   │   │       ├── PatientController.php
│   │   │       └── PrescriptionController.php
│   │   ├── Middleware/
│   │   └── Kernel.php
│   ├── Models/
│   │   ├── Appointment.php
│   │   ├── Address.php
│   │   ├── Patient.php
│   │   ├── Prescription.php
│   │   └── User.php
├── config/
├── database/
├── public/
├── routes/
│   └── api.php
├── storage/
├── tests/
├── artisan
├── composer.json
└── package.json
```

---

## Features

-   User registration, login, and logout (Authentication with Sanctum)
-   CRUD operations for appointments, patients, addresses, and prescriptions
-   Middleware to protect routes and ensure access only to authenticated users
-   HTTP request validations
-   Model relationships (e.g., appointment linked to a patient)
-   RESTful API with clean and organized routes

---

## Installation

1. Clone the repository:

```bash
git clone git@github.com:LSCasas/saludDigna-api.git
cd saludDigna-api
```

2. Install PHP dependencies:

```bash
composer install
```

3. Copy and configure the environment file:

```bash
cp .env.example .env
```

Configure the environment variables, especially the database connection.

4. Generate the application key:

```bash
php artisan key:generate
```

5. Run migrations to create database tables:

```bash
php artisan migrate
```

6. (Optional) Run seeders if available for test data:

```bash
php artisan db:seed
```

7. Start the development server:

```bash
php artisan serve
```

---

## Usage

The API is consumed via HTTP requests to the endpoints defined in `routes/api.php`. Authentication is required to access protected routes.

To register, use the POST endpoint `/api/register` with:

```json
{
    "name": "Your Name",
    "email": "your.email@example.com",
    "password": "your_password"
}
```

To log in, use the POST endpoint `/api/login` with:

```json
{
    "email": "your.email@example.com",
    "password": "your_password"
}
```

Once authenticated, send the authentication token (Bearer Token) in the `Authorization` header to access protected routes.

---

## Requirements

-   PHP 8.x or higher
-   Laravel 10.x
-   Composer
-   Compatible database (MySQL, PostgreSQL, SQLite, etc.)
-   Laravel Sanctum for API authentication

---

## Learn More

-   [Laravel Documentation](https://laravel.com/docs)
-   [Laravel Sanctum](https://laravel.com/docs/sanctum)
-   [Eloquent ORM](https://laravel.com/docs/eloquent)
-   [API Resources](https://laravel.com/docs/eloquent-resources)
