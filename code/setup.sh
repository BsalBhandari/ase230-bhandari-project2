#!/bin/bash

# Project 2 - Docker Deployment Script
# This script sets up and runs the Laravel application using Docker

set -e

echo "🐳 Starting Project 2 Deployment (Docker)"

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker is not installed. Please install Docker."
    exit 1
fi

# Check if Docker Compose is installed
if ! docker compose version &> /dev/null; then
    echo "❌ Docker Compose is not installed. Please install Docker Compose."
    exit 1
fi

echo -e "${YELLOW}📝 Setting up environment...${NC}"
if [ ! -f .env ]; then
    cp .env.example .env
    echo -e "${GREEN}✓ Created .env file${NC}"
    # Update database config for Docker
    sed -i.bak 's/DB_HOST=127.0.0.1/DB_HOST=db/' .env
    sed -i.bak 's/DB_DATABASE=ase230_project2/DB_DATABASE=ase230_project2/' .env
    sed -i.bak 's/DB_USERNAME=root/DB_USERNAME=ase230_user/' .env
    sed -i.bak 's/DB_PASSWORD=/DB_PASSWORD=root/' .env
    rm .env.bak 2>/dev/null || true
    echo -e "${GREEN}✓ Updated .env for Docker${NC}"
else
    echo -e "${GREEN}✓ .env file already exists${NC}"
fi

echo -e "${YELLOW}🐳 Building Docker containers...${NC}"
docker compose build

echo -e "${YELLOW}🚀 Starting Docker containers...${NC}"
docker compose up -d

echo -e "${YELLOW}⏳ Waiting for database to be ready...${NC}"
sleep 10

echo -e "${YELLOW}📦 Installing Composer dependencies...${NC}"
docker compose exec -T app composer install --no-interaction --prefer-dist --optimize-autoloader

echo -e "${YELLOW}🔑 Generating application key...${NC}"
docker compose exec -T app php artisan key:generate

echo -e "${YELLOW}🗄️  Running migrations...${NC}"
docker compose exec -T app php artisan migrate --force

echo -e "${YELLOW}🌱 Seeding database...${NC}"
docker compose exec -T app php artisan db:seed --force

echo -e "${YELLOW}📦 Optimizing application...${NC}"
docker compose exec -T app php artisan config:cache
docker compose exec -T app php artisan route:cache
docker compose exec -T app php artisan view:cache

echo -e "${GREEN}✅ Deployment complete!${NC}"
echo -e "${GREEN}🚀 Application is running at: http://localhost:8000${NC}"
echo -e "${YELLOW}To view logs: docker compose logs -f${NC}"
echo -e "${YELLOW}To stop: docker compose down${NC}"

