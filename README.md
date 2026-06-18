# HRMS - Laravel

A production-style Human Resource Management System built with Laravel 12, MySQL, Bootstrap 5, jQuery, DataTables, and SweetAlert2.

## Project Goal

The goal of this project is to build a complete HRMS application from scratch using Laravel best practices. The system will manage employees, departments, designations, attendance, leave requests, payroll records, dashboards, and reports.

This project is being developed as a portfolio-ready application with clean architecture, proper database design, maintainable code structure, and production-level development practices.

## Documentation

- [Database ERD](docs/database/erd.md)
- [Authentication & Authorization](docs/authentication-authorization.md)
- [Testing & Quality Review](docs/testing-quality.md)

## Technology Stack

* PHP 8.x
* Laravel 12
* MySQL 8.x
* Bootstrap 5
* jQuery
* DataTables
* SweetAlert2
* Vite
* Git and GitHub

## Core Modules

* Authentication
* Role and Permission Management
* Employee Management
* Department Management
* Designation Management
* Attendance Management
* Leave Management
* Payroll Management
* Dashboard
* Reports

## Planned Roles

* Super Admin
* HR Manager
* Employee

## Development Principles

* Clean code structure
* Thin controllers
* Form Request validation
* Service classes for business logic when needed
* Proper Eloquent relationships
* Secure environment configuration
* Migration-based database versioning
* Git commit best practices
* Production-aware architecture decisions

## Current Status

Project initialization is in progress.

Completed:

* Laravel 12 project installation
* Git initialization
* MySQL database connection
* Laravel foundation migrations
* Local development server test
* Frontend dependency installation and build verification

## Local Development Setup

Clone the repository:

```bash
git clone <repository-url>
cd hrms-laravel
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Start Laravel development server:

```bash
php artisan serve
```

Start frontend development server:

```bash
npm run dev
```

## Environment Notes

The application uses MySQL as the primary database connection.

Example database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hrms_laravel
DB_USERNAME=hrms_user
DB_PASSWORD=
```

The real database password must be stored only in the local `.env` file and must never be committed to Git.

## License

This project is open-source and developed for educational and portfolio purposes.
