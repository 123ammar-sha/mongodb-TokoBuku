FROM php:8.2-apache

# Mengubah port default Apache dari 80 ke 7860 demi Hugging Face
RUN sed -i 's/Listen 80/Listen 7860/' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:7860>/' /etc/apache2/sites-available/000-default.conf

# Instal dependensi sistem, git, unzip (wajib untuk Composer), dan ekstensi MongoDB
RUN apt-get update && apt-get install -y \
    libssl-dev \
    git \
    unzip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# 💡 KUNCI PERBAIKAN 1: Ambil Composer resmi ke dalam server
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tentukan folder kerja utama
WORKDIR /var/www/html/

# Salin seluruh kode proyek kamu ke dalam folder server
COPY . /var/www/html/

# 💡 KUNCI PERBAIKAN 2: Jalankan instalasi library Composer secara otomatis di server
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb

# Atur hak akses folder agar Apache bisa membaca file dengan lancar
RUN chown -R www-data:www-data /var/www/html

# Buka port 7860
EXPOSE 7860