# Project Installation Guide

## Prerequisites

Make sure the following are installed:

- PHP 8.2 or higher
- Composer
- Node.js (v18 or higher recommended)
- npm
- Database (SQLite / MySQL / PostgreSQL)

---

## Installation Steps

### 1. Clone the repository

```bash
git clone https://github.com/yash-cli/infynno-solution-task.git
cd ./infynno-solution-task/
````

---

### 2. Install PHP dependencies

```bash
composer install
```

---

### 3. Create environment file

```bash
cp .env.example .env
```

---

### 4. Generate application key

```bash
php artisan key:generate
```

---

### 5. Configure database

#### Option A: SQLite (quick setup)

```bash
touch database/database.sqlite
```

Update `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

---

#### Option B: MySQL / PostgreSQL

Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

### 6. Run database migrations

```bash
php artisan migrate
```

---

### 7. Install frontend dependencies (Laravel Breeze)

Laravel Breeze requires frontend assets to be built.

Install npm dependencies:

```bash
npm install
```

Build assets for development:

```bash
npm run build
```

> This step is required for Breeze authentication pages (login, register, etc.)
> to display correctly.

---

## Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

Application URL:

```
http://127.0.0.1:8000
```

---

## Useful Commands

Clear application cache:

```bash
php artisan optimize:clear
```

Re-run migrations:

```bash
php artisan migrate:fresh
```

Rebuild frontend assets:

```bash
npm run build
```

---
