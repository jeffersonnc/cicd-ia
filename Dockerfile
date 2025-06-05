# Usar imagen oficial de PHP con Apache
FROM php:8.2-apache

# Información del mantenedor
LABEL maintainer="jeffnacato"
LABEL description="CICD-IA - Aplicación PHP de ejemplo con CI/CD"
LABEL version="1.0.0"

# Instalar extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de configuración primero (para cache de capas)
COPY composer.json composer.lock ./

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copiar el código fuente
COPY . .

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && echo '<VirtualHost *:80>...\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite

# Exponer puerto 80
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]