# Usamos una imagen que ya tiene PHP y Apache (servidor web) juntos
FROM php:8.2-apache

# Instalamos las extensiones para que puedas conectar a la base de datos (MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitamos una función de Apache para que las URLs funcionen bien
RUN a2enmod rewrite

# Copiamos TODOS tus archivos a la carpeta pública del servidor
COPY . /var/www/html/

# Le decimos a Docker que este contenedor usará el puerto 80
EXPOSE 80
