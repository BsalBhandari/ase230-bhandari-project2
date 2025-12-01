# ASE230 Project 2 - Laravel REST API

## Project Overview

This project re-implements Project 1 APIs using Laravel framework with Docker containerization, Hugo documentation, and automatic GitHub.io deployment.

## Project Structure

```
ase230-bhandari-project2/
├── code/                    # Laravel application
│   ├── app/                 # Application code
│   │   ├── Http/Controllers/  # API controllers
│   │   └── Models/            # Eloquent models
│   ├── database/            # Migrations and seeders
│   ├── routes/              # API routes
│   ├── docker/              # Docker configuration
│   ├── Dockerfile           # Docker image definition
│   ├── docker-compose.yml   # Docker Compose config
│   ├── run.sh               # Shell deployment script
│   └── setup.sh             # Docker deployment script
├── presentation/            # Hugo documentation site
│   ├── content/             # Markdown content
│   ├── config.toml          # Hugo configuration
│   └── static/              # Static assets
├── plan/                    # Project planning documents
│   └── plan.md              # Project plan
└── .github/                  # GitHub Actions workflows
    └── workflows/
        └── deploy.yml        # GitHub Pages deployment
```

## Features

✅ **Laravel REST API** - Re-implements all Project 1 endpoints  
✅ **Laravel Sanctum** - API token authentication  
✅ **Docker Deployment** - Containerized application  
✅ **Shell Script Deployment** - One-command deployment  
✅ **Hugo Documentation** - Static site documentation  
✅ **GitHub Actions** - Automatic deployment to GitHub.io  

## Quick Start

### Using Docker (Recommended)

```bash
cd code
chmod +x setup.sh
./setup.sh
```

The application will be available at `http://localhost:8000`

### Using Shell Script

```bash
cd code
chmod +x run.sh
./run.sh
```

## API Endpoints

All Project 1 endpoints are re-implemented:

- `POST /api/users/register` - Register new user
- `POST /api/users/login` - User login
- `GET /api/users/profile` - Get user profile
- `GET /api/courses` - List all courses
- `POST /api/courses` - Create course
- `GET /api/courses/{id}` - Get course details
- `PUT /api/courses/{id}` - Update course
- `DELETE /api/courses/{id}` - Delete course
- `GET /api/enrollments` - List enrollments
- `POST /api/enrollments` - Enroll in course
- `PUT /api/enrollments/{id}` - Update enrollment
- `DELETE /api/enrollments/{id}` - Drop enrollment

## Documentation

- [API Tutorial](https://bsalbhandari.github.io/ase230-bhandari-project2/api-tutorial/)
- [Deployment Guide](https://bsalbhandari.github.io/ase230-bhandari-project2/deployment/)
- [Portfolio](https://bsalbhandari.github.io/ase230-bhandari-project2/portfolio/)

## Technologies

- **Backend:** Laravel 10.x, PHP 8.2
- **Database:** MySQL 8.0
- **Authentication:** Laravel Sanctum
- **Containerization:** Docker, Docker Compose
- **Web Server:** Nginx
- **Documentation:** Hugo Static Site Generator
- **CI/CD:** GitHub Actions

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL/MariaDB
- Docker and Docker Compose (for Docker deployment)
- Hugo (for documentation)

## Installation

### Prerequisites

1. Install PHP 8.2+
2. Install Composer
3. Install MySQL
4. (Optional) Install Docker and Docker Compose

### Setup

1. Clone the repository:
```bash
git clone https://github.com/BsalBhandari/ase230-bhandari-project2.git
cd ase230-bhandari-project2
```

2. For Docker deployment:
```bash
cd code
./setup.sh
```

3. For shell script deployment:
```bash
cd code
./run.sh
```

## Testing

API endpoints can be tested using:
- cURL commands
- Postman
- Browser (for GET requests)

See the [API Tutorial](https://bsalbhandari.github.io/ase230-bhandari-project2/api-tutorial/) for detailed examples.

## Deployment

### Docker Deployment

See `code/setup.sh` for automated Docker deployment.

### Shell Script Deployment

See `code/run.sh` for automated shell script deployment.

### GitHub.io Documentation

The Hugo documentation site is automatically deployed to GitHub.io via GitHub Actions when changes are pushed to the `main` branch.

## Project Status

- [x] Project structure created
- [x] Laravel models and controllers created
- [x] Database migrations created
- [x] Docker configuration created
- [x] Deployment scripts created
- [x] Hugo documentation structure created
- [x] GitHub Actions workflow created
- [ ] Laravel application setup (requires `composer create-project`)
- [ ] Testing and validation
- [ ] Final documentation

## Contributing

This is a course project. For questions or issues, please contact the project maintainer.

## License

This project is for educational purposes only.

## Author

**Bishal Bhandari**  
ASE230 - Server-Side Programming  
Northern Kentucky University

## Repository

[GitHub Repository](https://github.com/BsalBhandari/ase230-bhandari-project2)

## Live Documentation

[GitHub.io Documentation](https://bsalbhandari.github.io/ase230-bhandari-project2/)

