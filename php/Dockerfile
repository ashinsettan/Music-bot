# Use PHP 8.1 with a slim image for lightweight setup
FROM php:8.1-cli

# Update package list and install required packages
RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y git curl ffmpeg unzip \
    && docker-php-ext-install pdo_mysql

# Install Composer for dependency management
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy PHP dependencies file if it exists
COPY composer.json /app/composer.json

# Install dependencies using Composer
WORKDIR /app
RUN if [ -f "composer.json" ]; then composer install; fi

# Set up working directory for the bot files
RUN mkdir -p /app/MusicPlayer
WORKDIR /app/MusicPlayer

# Copy the rest of the bot files into the container
COPY . /app/MusicPlayer

# Grant execute permissions to the startup script
RUN chmod +x /app/MusicPlayer/startup.sh

# Set the default command to run the bot
CMD ["/bin/bash", "/app/MusicPlayer/startup.sh"]
