
## Banking System

This Laravel project is a simple banking system that allows users to create accounts, log in, deposit money into their accounts, and withdraw money from their accounts.

## Table of Contents
- Installation
- Features

## Installation

Follow these steps to set up and run the project:

### 1. Clone the repository:
  https://github.com/sabahraad/Banking-system.git
### 2. Navigate to the project directory:
 cd Banking-system
### 3. Install composer dependencies:
 composer install
### 4. Create a copy of the .env.example file and rename it to .env:
 cp .env.example .env
### 5. Generate an application key:
 php artisan key: generate
### 6. Configure your database in the .env file:
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=your_database_name
 DB_USERNAME=your_database_username
 DB_PASSWORD=your_database_password
### 7. Migrate the database:
 php artisan migrate
### 8. Start the development server:
 php artisan serve

## Features
1. User authentication (registration, login, logout)
2. User Type (Individual, Business)
3. Account management (deposit, withdraw)
4. Transaction history

