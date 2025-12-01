# Laravel Project Setup Instructions

## Initial Setup

This directory contains the Laravel application structure. To complete the setup, you need to initialize a new Laravel project.

### Step 1: Initialize Laravel Project

If this directory is empty or you're starting fresh:

```bash
cd /path/to/ase230-bhandari-project2/code
composer create-project laravel/laravel .
```

Or if you want to keep the existing structure:

```bash
composer create-project laravel/laravel temp-laravel
cp -r temp-laravel/* .
cp -r temp-laravel/.* . 2>/dev/null || true
rm -rf temp-laravel
```

### Step 2: Install Laravel Sanctum

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

### Step 3: Configure Sanctum

Add Sanctum middleware to `app/Http/Kernel.php`:

```php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

### Step 4: Copy Application Files

The following files are already created and should be copied/merged:

- `app/Models/` - Eloquent models
- `app/Http/Controllers/` - API controllers
- `routes/api.php` - API routes
- `database/migrations/` - Database migrations
- `database/seeders/` - Database seeders

### Step 5: Update .env

Copy `.env.example` to `.env` and update:

```env
APP_NAME="ASE230 Project 2"
APP_ENV=local
APP_KEY=  # Will be generated
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ase230_project2
DB_USERNAME=root
DB_PASSWORD=
```

### Step 6: Run Setup

Use the deployment scripts:

**Docker:**
```bash
./setup.sh
```

**Shell Script:**
```bash
./run.sh
```

## File Structure After Setup

```
code/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── UserController.php
│   │       ├── CourseController.php
│   │       └── EnrollmentController.php
│   └── Models/
│       ├── User.php
│       ├── Course.php
│       └── Enrollment.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_01_000002_create_courses_table.php
│   │   └── 2024_01_01_000003_create_enrollments_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── routes/
│   └── api.php
├── docker/
│   ├── nginx/
│   │   └── default.conf
│   └── php/
│       └── local.ini
├── Dockerfile
├── docker-compose.yml
├── run.sh
├── setup.sh
└── .env.example
```

## Troubleshooting

### Composer Issues

If you encounter composer issues:
```bash
composer install --no-scripts
composer dump-autoload
```

### Permission Issues

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Database Connection

Ensure MySQL is running and credentials in `.env` are correct.

