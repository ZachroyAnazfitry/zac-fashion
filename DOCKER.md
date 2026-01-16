# Docker Setup Guide

This project follows Docker and Laravel best practices with separate containers for development and production environments.

## 📁 Project Structure

```
docker/
├── php/
│   ├── Dockerfile              # PHP-FPM production image
│   └── php-fpm-healthcheck.sh  # Health check script
└── nginx/
    ├── nginx.conf              # Main Nginx configuration
    └── default.conf            # Laravel-specific server configuration

compose.dev.yaml                # Development environment (Laravel Sail)
compose.prod.yaml               # Production environment (Nginx + PHP-FPM)
.dockerignore                   # Files excluded from Docker builds
```

## 🚀 Quick Start

### Development Environment

The development environment uses Laravel Sail for simplicity and fast iteration.

```bash
# Start development environment
docker compose -f compose.dev.yaml up -d

# Run artisan commands
docker compose -f compose.dev.yaml exec laravel.test php artisan migrate

# View logs
docker compose -f compose.dev.yaml logs -f

# Stop environment
docker compose -f compose.dev.yaml down
```

**Services:**
- Laravel app (Caddy web server) - Port 80
- MySQL 8.0 - Port 3307
- Redis - Port 6379
- Mailpit (email testing) - Ports 1025, 8025

### Production Environment

The production environment uses separate Nginx and PHP-FPM containers following industry best practices.

```bash
# Build and start production environment
docker compose -f compose.prod.yaml up -d --build

# Run migrations
docker compose -f compose.prod.yaml exec php-fpm php artisan migrate --force

# View logs
docker compose -f compose.prod.yaml logs -f nginx
docker compose -f compose.prod.yaml logs -f php-fpm

# Stop environment
docker compose -f compose.prod.yaml down
```

**Services:**
- Nginx (web server) - Port 80, 443
- PHP-FPM (application) - Internal port 9000
- MySQL 8.0 - Port 3306
- Redis 7 - Port 6379

## 🏗️ Architecture

### Production Architecture

```
┌─────────────────┐
│     Nginx       │  ← Handles HTTP/HTTPS, static files, reverse proxy
│   (Port 80/443) │
└────────┬────────┘
         │
         │ FastCGI
         ▼
┌─────────────────┐
│    PHP-FPM      │  ← Runs Laravel application
│  (Port 9000)    │
└────────┬────────┘
         │
         ├─────────► MySQL (Database)
         └─────────► Redis (Cache/Sessions)
```

### Benefits of This Architecture

1. **Separation of Concerns**: Web server and application are isolated
2. **Scalability**: Can scale PHP-FPM and Nginx independently
3. **Performance**: Nginx efficiently serves static files
4. **Security**: Better isolation and security boundaries
5. **Maintainability**: Easier to update and maintain each component

## 🔧 Configuration

### Environment Variables

Create a `.env` file with the following variables:

```env
APP_NAME=ZacFashion
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=zac_fashion
DB_USERNAME=your_username
DB_PASSWORD=your_password

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

APP_PORT=80
APP_HTTPS_PORT=443
FORWARD_DB_PORT=3306
FORWARD_REDIS_PORT=6379
```

### Nginx Configuration

The Nginx configuration is optimized for Laravel:

- **Static file caching**: 1 year cache for assets
- **Security headers**: X-Frame-Options, X-Content-Type-Options, etc.
- **Gzip compression**: Enabled for text-based files
- **PHP-FPM**: Properly configured FastCGI pass
- **Laravel routing**: Correct `try_files` directive

### PHP-FPM Configuration

The PHP-FPM container includes:

- **OPcache**: Enabled and optimized for production
- **PHP Extensions**: All Laravel required extensions
- **Redis Extension**: For caching and sessions
- **Optimized Settings**: Memory limits, upload sizes, etc.

## 📦 Building Images

### Build PHP-FPM Image

```bash
docker build -f docker/php/Dockerfile -t zac-fashion-php:latest .
```

### Multi-stage Build Process

The PHP-FPM Dockerfile uses a multi-stage build:

1. **Stage 1 (vendor)**: Installs Composer dependencies
2. **Stage 2 (frontend)**: Builds frontend assets with Node.js
3. **Stage 3 (php-fpm)**: Creates final PHP-FPM image with all dependencies

This approach:
- Reduces final image size
- Improves build caching
- Separates build-time and runtime dependencies

## 🧪 Testing

### Health Checks

All services include health checks:

```bash
# Check service health
docker compose -f compose.prod.yaml ps

# Manual health check
docker compose -f compose.prod.yaml exec php-fpm php -v
docker compose -f compose.prod.yaml exec nginx nginx -t
```

### Running Tests

```bash
# Run PHPUnit tests
docker compose -f compose.prod.yaml exec php-fpm php artisan test

# Run with coverage
docker compose -f compose.prod.yaml exec php-fpm php artisan test --coverage
```

## 🚢 Deployment

### Local Production Testing

```bash
# Start production environment
docker compose -f compose.prod.yaml up -d

# Run migrations and seeders
docker compose -f compose.prod.yaml exec php-fpm php artisan migrate --force
docker compose -f compose.prod.yaml exec php-fpm php artisan db:seed --force

# Optimize for production
docker compose -f compose.prod.yaml exec php-fpm php artisan config:cache
docker compose -f compose.prod.yaml exec php-fpm php artisan route:cache
docker compose -f compose.prod.yaml exec php-fpm php artisan view:cache
```

### CI/CD Integration

The project includes GitHub Actions workflow (`.github/workflows/ci.yml`) that:

1. Builds the PHP-FPM Docker image
2. Pushes to Amazon ECR
3. Deploys to AWS ECS

For ECS deployment, you'll need:
- Separate ECS services for Nginx and PHP-FPM, OR
- Use Application Load Balancer (ALB) with PHP-FPM containers
- Configure ECS task definitions for both services

## 🔒 Security Best Practices

1. **Read-only volumes**: Public directory mounted as read-only
2. **Non-root user**: PHP-FPM runs as `www-data`
3. **Security headers**: Configured in Nginx
4. **Hidden files**: Denied access to `.env`, `.git`, etc.
5. **OPcache**: Enabled for performance and security

## 📊 Monitoring

### View Logs

```bash
# All services
docker compose -f compose.prod.yaml logs -f

# Specific service
docker compose -f compose.prod.yaml logs -f nginx
docker compose -f compose.prod.yaml logs -f php-fpm
docker compose -f compose.prod.yaml logs -f mysql
```

### Resource Usage

```bash
# Container stats
docker compose -f compose.prod.yaml stats
```

## 🛠️ Troubleshooting

### Permission Issues

```bash
# Fix storage permissions
docker compose -f compose.prod.yaml exec php-fpm chown -R www-data:www-data storage bootstrap/cache
docker compose -f compose.prod.yaml exec php-fpm chmod -R 775 storage bootstrap/cache
```

### Clear Caches

```bash
docker compose -f compose.prod.yaml exec php-fpm php artisan cache:clear
docker compose -f compose.prod.yaml exec php-fpm php artisan config:clear
docker compose -f compose.prod.yaml exec php-fpm php artisan route:clear
docker compose -f compose.prod.yaml exec php-fpm php artisan view:clear
```

### Rebuild Containers

```bash
# Rebuild without cache
docker compose -f compose.prod.yaml build --no-cache

# Rebuild and restart
docker compose -f compose.prod.yaml up -d --build --force-recreate
```

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Docker Best Practices](https://docs.docker.com/develop/dev-best-practices/)
- [Nginx Configuration Guide](https://nginx.org/en/docs/)
- [PHP-FPM Configuration](https://www.php.net/manual/en/install.fpm.configuration.php)

## 🤝 Contributing

When adding new services or modifying Docker configuration:

1. Update this documentation
2. Test in both development and production environments
3. Ensure health checks are working
4. Update CI/CD pipeline if needed
