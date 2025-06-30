# Usando uma imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instalar extensões necessárias, incluindo pdo_mysql e mysqli
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar o mod_rewrite do Apache
RUN a2enmod rewrite

# Copia os arquivos do projeto para o diretório raiz do Apache
COPY . /var/www/html/

# Define o diretório de trabalho padrão
WORKDIR /var/www/html/

# Expondo a porta 80 para o Apache
EXPOSE 80
