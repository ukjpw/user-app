## About This Application

This application calls an API to manage users.

It allows the end-user to:
   - List existing users
   - Update details of existing users
   - Create new users

### Application Architecture Summary
- Backend is Laravel v11.7.0
- Frontend is:
   - Laravel v11.7.0 Blade
   - VueJS v3,
   - Javascript ES6
   - Typescript v5.3.3
   - HTML v5
   - CSS v3
 

### How to Deploy Application (Linux Server or WSL) - Commands

#### Create Laravel Application
  1) composer create-project laravel/laravel app-name
  2) cd app-name
   
#### Install PHP Extensions using apt
  1) sudo apt update
  2) sudo apt upgrade
  3) sudo apt install php php-cli php-common php-mbstring php-xml php-zip php-mysql php-pgsql php-sqlite3 php-json php-bcmath php-gd php-tokenizer php-xmlwriter php-curl
  
#### Ensure storage directory us writable 
  1) chown -R user:group /var/www/html/user-app/storage

#### Install Vue Packages
  1) npm install vue@latest
  2) npm install vue @vitejs/plugin-vue

#### Install Composer Dependencies
  1) curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
  2) sudo composer install
  3) sudo composer update

#### Configure SQLite and MockAPI Endpoint
  DB_CONNECTION=sqlite
  DB_DATABASE=[absolute path in laravel app, usually database/database.sqlite] 
  USER_API_ENDPOINT_URL="https://66445e4a6c6a6565870a160d.mockapi.io/api/v1"  

### How to Run Applicationin dev environment (Using Vite)
   1) npm run dev
   2) In browser, go to: http://localhost:8000/
