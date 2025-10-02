#!/bin/bash

# Qudrat100 Development Environment Startup Script
# This script starts the Docker development environment that matches XAMPP

set -e

echo "🚀 Starting Qudrat100 Development Environment..."

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker Desktop first."
    exit 1
fi

# Check if Docker Compose is available
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose is not installed or not in PATH."
    exit 1
fi

# Navigate to the docker directory
cd "$(dirname "$0")"

# Copy environment file if it doesn't exist
if [ ! -f .env ]; then
    if [ -f .env.dev ]; then
        cp .env.dev .env
        echo "📋 Copied .env.dev to .env"
    else
        echo "❌ No environment file found. Please create .env or .env.dev"
        exit 1
    fi
fi

# Stop any existing containers
echo "🛑 Stopping existing containers..."
docker-compose -f docker-compose.dev.yml down --remove-orphans

# Remove any existing volumes if requested
if [ "$1" = "--fresh" ]; then
    echo "🗑️  Removing existing volumes for fresh start..."
    docker-compose -f docker-compose.dev.yml down -v
    docker volume prune -f
fi

# Build and start containers
echo "🔨 Building and starting containers..."
docker-compose -f docker-compose.dev.yml up --build -d

# Wait for services to be ready
echo "⏳ Waiting for services to be ready..."
sleep 10

# Check if MySQL is ready
echo "🔍 Checking MySQL connection..."
for i in {1..30}; do
    if docker-compose -f docker-compose.dev.yml exec -T mysql mysqladmin ping -h localhost --silent; then
        echo "✅ MySQL is ready!"
        break
    fi
    if [ $i -eq 30 ]; then
        echo "❌ MySQL failed to start after 30 attempts"
        exit 1
    fi
    echo "⏳ Waiting for MySQL... (attempt $i/30)"
    sleep 2
done

# Check if WordPress is ready
echo "🔍 Checking WordPress connection..."
for i in {1..30}; do
    if curl -f http://localhost:8080 > /dev/null 2>&1; then
        echo "✅ WordPress is ready!"
        break
    fi
    if [ $i -eq 30 ]; then
        echo "❌ WordPress failed to start after 30 attempts"
        exit 1
    fi
    echo "⏳ Waiting for WordPress... (attempt $i/30)"
    sleep 2
done

# Display service URLs
echo ""
echo "🎉 Development environment is ready!"
echo ""
echo "📱 Service URLs:"
echo "   WordPress:      http://localhost:8080"
echo "   Quiz App:       http://localhost:8080/quiz.php"
echo "   Admin Panel:    http://localhost:8080/admin.php"
echo "   Demo:           http://localhost:8080/demo.php"
echo "   phpMyAdmin:     http://localhost:8081"
echo "   Redis Commander: http://localhost:8082"
echo ""
echo "🔑 Default Credentials:"
echo "   WordPress Admin: admin / admin123"
echo "   MySQL Root:      root / root_password"
echo "   MySQL User:      qudrat100_user / qudrat100_pass"
echo "   Redis:           redis_pass"
echo ""
echo "📊 Container Status:"
docker-compose -f docker-compose.dev.yml ps

echo ""
echo "💡 Useful Commands:"
echo "   View logs:       docker-compose -f docker-compose.dev.yml logs -f"
echo "   Stop services:   docker-compose -f docker-compose.dev.yml down"
echo "   Restart:         ./start-dev.sh"
echo "   Fresh start:     ./start-dev.sh --fresh"
echo ""
echo "🔧 Development Tips:"
echo "   - Files are synced with your local wp-content directory"
echo "   - Changes to PHP files are reflected immediately"
echo "   - Database data persists between restarts"
echo "   - Use --fresh flag to reset everything"