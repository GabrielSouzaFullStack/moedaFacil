#!/bin/bash

# Exibe as informações de ambiente
echo "PHP Version:"
php -v

# Instala as dependências do Composer
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Dump autoload com autorização de classmap
echo "Optimizing autoloader..."
composer dump-autoload --optimize --classmap-authoritative

# Cria um link simbólico para a pasta app/core dentro de api
echo "Creating symlink for Router..."
mkdir -p api/core
cp app/core/Router.php api/core/

# Exibe a estrutura de arquivos para verificação
echo "File structure:"
ls -la

echo "Build completed successfully!"