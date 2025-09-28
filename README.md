# Order & Payment Management API

A Laravel 12 based REST API for managing **Orders** and **Payments**, built with clean code principles and extensibility in mind.  

The project demonstrates:  
- Repository Pattern for data access  
- Strategy Pattern for payment gateways  
- JWT Authentication (using tymon/jwt-auth)  
- Orders & Payments modules (models, migrations, controllers, services)  
- Unit & Feature Tests (`tests/Unit`, `tests/Feature`)  
- SQLite in-memory config for fast testing (`phpunit.xml`)  

## 📂 Project Structure
app/
Http/Controllers/
OrderController.php
PaymentController.php
Models/
Order.php
Payment.php
Repositories/
OrderRepository.php
PaymentRepository.php
Services/Payments/
PaymentService.php
Gateways/
PaymentGatewayInterface.php
PaypalGateway.php
CreditCardGateway.php
config/
payment_gateways.php
database/
migrations/
postman/
collection.json
tests/
Feature/
Unit/
routes/
api.php


## 🚀 Setup Instructions

1. **Clone repository**
```bash
git clone https://github.com/Mostapha94/order-managment.git
cd order-managment
composer install
cp .env.example .env
php artisan key:generate
Update .env with your DB settings (MySQL, SQLite, etc.).
php artisan migrate
