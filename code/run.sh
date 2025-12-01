#!/bin/bash

# Project 2 - Shell Script Deployment
# This script sets up and runs the Laravel application without Docker

set -e

echo "🚀 Starting Project 2 Deployment (Shell Script)"

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.2 or higher."
    exit 1
fi

# Check if Composer is installed
if command -v composer &> /dev/null; then
    COMPOSER_CMD="composer"
elif [ -f "./composer.phar" ]; then
    COMPOSER_CMD="php composer.phar"
    echo -e "${YELLOW}ℹ️  Using local composer.phar${NC}"
else
    echo "❌ Composer is not installed. Please install Composer."
    exit 1
fi

# Check if MySQL is running
if ! command -v mysql &> /dev/null; then
    echo "⚠️  MySQL client not found. Make sure MySQL server is running."
fi

echo -e "${YELLOW}📦 Installing dependencies...${NC}"
$COMPOSER_CMD install --no-interaction --prefer-dist --optimize-autoloader

echo -e "${YELLOW}📝 Setting up environment...${NC}"
if [ ! -f .env ]; then
    cp .env.example .env
    echo -e "${GREEN}✓ Created .env file${NC}"
    echo -e "${YELLOW}⚠️  Please update .env with your database credentials${NC}"
else
    echo -e "${GREEN}✓ .env file already exists${NC}"
fi

echo -e "${YELLOW}🔑 Generating application key...${NC}"
php artisan key:generate

echo -e "${YELLOW}🗄️  Running migrations...${NC}"
php artisan migrate --force

echo -e "${YELLOW}🌱 Seeding database...${NC}"
php artisan db:seed --force

echo -e "${YELLOW}📦 Optimizing application...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo -e "${GREEN}✅ Deployment complete!${NC}"
echo -e "${GREEN}🚀 Starting Laravel development server...${NC}"
echo -e "${YELLOW}Access the API at: http://localhost:8000${NC}"

php artisan serve --host=0.0.0.0 --port=8000

