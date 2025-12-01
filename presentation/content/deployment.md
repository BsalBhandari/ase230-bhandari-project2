---
title: "Deployment Guide"
date: 2025-01-01
draft: false
---

# Deployment Guide

This guide covers how to deploy the Laravel REST API application using different methods.

## Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL/MariaDB
- Docker and Docker Compose (for Docker deployment)

## Method 1: Shell Script Deployment

### Using `run.sh`

The `run.sh` script provides a one-command deployment for the Laravel application.

```bash
cd code
chmod +x run.sh
./run.sh
```

### What it does:

1. Checks for PHP and Composer
2. Installs Composer dependencies
3. Sets up `.env` file
4. Generates application key
5. Runs database migrations
6. Seeds the database
7. Optimizes the application
8. Starts the development server

The application will be available at `http://localhost:8000`

## Method 2: Docker Deployment

### Using `setup.sh`

The `setup.sh` script provides a one-command Docker deployment.

```bash
cd code
chmod +x setup.sh
./setup.sh
```

### What it does:

1. Checks for Docker and Docker Compose
2. Sets up `.env` file for Docker
3. Builds Docker containers
4. Starts all services (app, nginx, database)
5. Installs Composer dependencies
6. Generates application key
7. Runs database migrations
8. Seeds the database
9. Optimizes the application

The application will be available at `http://localhost:8000`

### Docker Services

- **app** - Laravel PHP-FPM application
- **nginx** - Web server (port 8000)
- **db** - MySQL database (port 3306)

### Docker Commands

```bash
# View logs
docker-compose logs -f

# Stop containers
docker-compose down

# Restart containers
docker-compose restart

# Access app container
docker-compose exec app bash

# Access database
docker-compose exec db mysql -u ase230_user -proot ase230_project2
```

## Manual Deployment

### Step 1: Install Dependencies

```bash
composer install
```

### Step 2: Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ase230_project2
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 3: Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### Step 4: Optimize Application

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 5: Start Server

```bash
php artisan serve
```

## Production Deployment

### Using Docker in Production

1. Update `docker-compose.yml` for production settings
2. Set proper environment variables
3. Use production-ready web server (Nginx/Apache)
4. Enable SSL/TLS certificates
5. Set up proper database backups

### Environment Variables for Production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### Security Checklist

- [ ] Change default passwords
- [ ] Use strong database passwords
- [ ] Enable HTTPS
- [ ] Set proper file permissions
- [ ] Configure firewall rules
- [ ] Set up regular backups
- [ ] Monitor application logs
- [ ] Keep dependencies updated

## Troubleshooting

### Common Issues

#### Database Connection Error

- Check database credentials in `.env`
- Ensure MySQL service is running
- Verify database exists

#### Permission Errors

```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### Port Already in Use

Change the port in `docker-compose.yml` or use a different port:

```bash
php artisan serve --port=8080
```

## Next Steps

- Set up CI/CD pipeline
- Configure monitoring and logging
- Set up automated backups
- Implement caching strategies
- Configure load balancing (if needed)

