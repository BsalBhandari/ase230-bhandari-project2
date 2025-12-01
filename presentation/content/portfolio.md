---
title: "Portfolio"
date: 2025-01-01
draft: false
---

# Project Portfolio

## ASE230 Project 2 - Laravel REST API

### Project Overview

This project demonstrates full-stack development skills including:
- Backend API development with Laravel
- Database design and ORM usage
- Containerization with Docker
- CI/CD with GitHub Actions
- Static site generation with Hugo

### Technologies Used

- **Backend:** Laravel 10.x, PHP 8.2
- **Database:** MySQL 8.0
- **Authentication:** Laravel Sanctum
- **Containerization:** Docker, Docker Compose
- **Web Server:** Nginx
- **Documentation:** Hugo Static Site Generator
- **CI/CD:** GitHub Actions

### Key Features

1. **RESTful API Design**
   - 8 complete API endpoints
   - RESTful conventions
   - JSON responses
   - Proper HTTP status codes

2. **Authentication & Authorization**
   - Laravel Sanctum token authentication
   - Role-based access control (Student, Instructor, Admin)
   - Secure password hashing
   - Token-based API access

3. **Database Design**
   - Normalized database schema
   - Foreign key relationships
   - Eloquent ORM models
   - Database migrations and seeders

4. **Deployment**
   - Docker containerization
   - Automated deployment scripts
   - Environment configuration
   - Production-ready setup

5. **Documentation**
   - Hugo static site
   - API documentation
   - Deployment guides
   - Automatic GitHub.io deployment

### Project Structure

```
ase230-bhandari-project2/
├── code/                    # Laravel application
│   ├── app/                 # Application code
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
└── plan/                    # Project planning documents
```

### API Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/api/users/register` | Register new user | No |
| POST | `/api/users/login` | User login | No |
| GET | `/api/users/profile` | Get user profile | Yes |
| GET | `/api/courses` | List all courses | No |
| POST | `/api/courses` | Create course | Yes (Instructor/Admin) |
| GET | `/api/courses/{id}` | Get course details | No |
| PUT | `/api/courses/{id}` | Update course | Yes (Instructor/Admin) |
| DELETE | `/api/courses/{id}` | Delete course | Yes (Admin) |
| GET | `/api/enrollments` | List enrollments | Yes |
| POST | `/api/enrollments` | Enroll in course | Yes (Student) |
| PUT | `/api/enrollments/{id}` | Update enrollment | Yes |
| DELETE | `/api/enrollments/{id}` | Drop enrollment | Yes |

### Accomplishments

✅ Re-implemented all Project 1 APIs using Laravel  
✅ Implemented Laravel Sanctum authentication  
✅ Created Docker containerization setup  
✅ Automated deployment with shell scripts  
✅ Built Hugo documentation site  
✅ Set up GitHub Actions for automatic deployment  
✅ Created comprehensive API documentation  
✅ Implemented role-based access control  
✅ Designed normalized database schema  
✅ Created database migrations and seeders  

### Learning Outcomes

- **Laravel Framework:** Gained experience with Laravel MVC architecture, Eloquent ORM, and Laravel Sanctum
- **Docker:** Learned containerization, Docker Compose, and multi-container applications
- **DevOps:** Implemented CI/CD pipelines with GitHub Actions
- **Documentation:** Created static site documentation with Hugo
- **API Design:** Designed RESTful APIs with proper authentication and authorization
- **Database Design:** Created normalized database schemas with proper relationships

### Future Enhancements

- [ ] Add unit and integration tests
- [ ] Implement API rate limiting
- [ ] Add API versioning
- [ ] Implement caching strategies
- [ ] Add real-time features with WebSockets
- [ ] Create frontend application
- [ ] Add more advanced features (assignments, grades, quizzes)
- [ ] Implement file upload functionality
- [ ] Add email notifications
- [ ] Set up monitoring and logging

### Repository

[GitHub Repository](https://github.com/BsalBhandari/ase230-bhandari-project2)

### Live Documentation

[GitHub.io Documentation](https://bsalbhandari.github.io/ase230-bhandari-project2/)

