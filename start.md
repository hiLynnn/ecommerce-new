# chạy lệnh 
com

# Lệnh chạy Composer
composer install

# Tạo file .env
cp .env.example .env

# Tạo key ứng dụng
php artisan key:generate

php artisan storage:link

php artisan migrate:refresh --seed

# Chạy lệnh yarn
yarn install

# Chạy ứng dụng với yarn
yarn dev