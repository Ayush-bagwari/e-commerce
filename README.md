## Ecommerce - Rest Api
This is a simple e-commerce site With following Features:
1. Rest Api Using JWT
 - User Register, Login, Logout, Profile View Api's  
 - Product Create, View Product, View All Products, Delete, Search Api's  
2. Web Interface Using Breeze
 - User Register, Login, Logout, Profile View , Update Password, Update User 
 - Dashboard
 - Product View
 - Add To Cart
 - Cart View

# instructions
 Composer
 PHP - 8.1
 Mysql
 JWT 

# Setup
1. Clone the e-commerce repo
2. Run composer install in terminal
3. Set up environment variables by copying `.env.example` to `.env` and updating the values
4. Add database info inside .env file
5. Run this command to generate jwt secret token: `php artisan jwt:secret `(this will be added automatically to .env file )
5. Run: php artisan migrate
6. Run: php artisan serve

# Setup Web And Rest API Endpoints
- POST /api/user/register : Register a new user
- POST /api/user/login : Login a user
- POST /api/user/logout : Logout a user
- POST /api/user/me : View user profile
- POST /api/products/create : Create new Product
- GET api/products/view/{id} : Fetch a specific product 
- GET /api/products : Fetch all products
- GET /api/products/search?name={name} : Search for products
