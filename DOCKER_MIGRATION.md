# Docker Migration Guide

## What Changed

The Docker setup has been refactored to follow industry best practices with separate containers for Nginx and PHP-FPM.

### Before
- Single container with both Nginx and PHP-FPM (`Dockerfile.production`)
- Combined startup script
- Basic Nginx configuration

### After
- **Separate containers**: Nginx and PHP-FPM in different containers
- **Multi-stage builds**: Optimized Dockerfile with separate build stages
- **Proper configuration**: Laravel-optimized Nginx configuration
- **Better organization**: Docker files organized in `docker/` directory
- **Environment separation**: `compose.dev.yaml` for development, `compose.prod.yaml` for production

## File Changes

### New Files
- `docker/php/Dockerfile` - PHP-FPM production image
- `docker/nginx/nginx.conf` - Main Nginx configuration
- `docker/nginx/default.conf` - Laravel server configuration
- `compose.prod.yaml` - Production Docker Compose file
- `compose.dev.yaml` - Development Docker Compose file (moved from `docker-compose.yml`)
- `.dockerignore` - Optimized build exclusions
- `DOCKER.md` - Comprehensive Docker documentation

### Updated Files
- `.github/workflows/ci.yml` - Updated to use new Dockerfile path
- `README.md` - Added Docker setup instructions

### Deprecated Files
- `Dockerfile.production` - **Can be removed** (replaced by `docker/php/Dockerfile`)
- `.docker/nginx.conf` - **Can be removed** (replaced by `docker/nginx/nginx.conf`)
- `.docker/start.sh` - **Can be removed** (no longer needed with separate containers)

## Migration Steps

### 1. Update CI/CD (Already Done)
The GitHub Actions workflow has been updated to use the new Dockerfile path:
```yaml
docker build -f docker/php/Dockerfile .
```

### 2. Update Local Development
If you're using the old `docker-compose.yml`, switch to:
```bash
docker compose -f compose.dev.yaml up -d
```

### 3. Update Production Deployment
For production, use the new compose file:
```bash
docker compose -f compose.prod.yaml up -d --build
```

### 4. Clean Up Old Files (Optional)
After verifying everything works, you can remove:
```bash
rm Dockerfile.production
rm -rf .docker/
```

## Benefits

1. **Scalability**: Can scale Nginx and PHP-FPM independently
2. **Performance**: Nginx efficiently serves static files
3. **Maintainability**: Clear separation of concerns
4. **Best Practices**: Follows Docker and Laravel recommendations
5. **Flexibility**: Easier to update individual components

## Backward Compatibility

The old `docker-compose.yml` file is still present and functional for development. However, it's recommended to use `compose.dev.yaml` for consistency.

For production, you **must** use `compose.prod.yaml` as the old `Dockerfile.production` approach is deprecated.

## Questions?

See [DOCKER.md](DOCKER.md) for detailed documentation on the new setup.
