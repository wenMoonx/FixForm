# 🚩 FixForm HomeAssessment Design.

## **Assessment Requirement** 📋

> It should be possible to browse a list of products

> Every product should have a product page where you can see an image, title, description and price 

> You can add a product to the cart 

> There should be an overview of all items added to the cart  


## **Tech Stacks** 🛠

### FrontEnd
- Vue3
- VueX 4.0
- Pinia 3.0
- Tailwind 3.0
- Inertia.js
### BackEnd
- Laravel 8.0
- Laravel Eloquent
- Laravel Sanctum
- MySql
### Other Libraries
- InertiaJs Testing
- Laravel Mix
- PHPUnit
- Git

## **Architecture and Design Patterns:** 🔏
- Follow Laravel's MVC (Model-View-Controller) architectural pattern to separate business logic, data handling, and presentation concerns.
- Use Laravel's built-in routing system to define API routes and handle incoming requests.
- Utilize Vue.js components to create a modular and reusable UI with clear separation of concerns.
- Implement separation of concerns and SOLID principles in the code to ensure maintainability and scalability.
- Utilize design patterns such as Dependency Injection, Singleton, and Repository pattern to write clean, maintainable, and testable code.

## **General Ideas:** ✒
### Frontend
- Install Vue 3 and Vue Router in the project using npm or yarn.
- Set up a Vue app with the Composition API, following best practices for component structure and organization.
- use Tailwind CSS for styling and design, following the documentation for integrating Tailwind CSS with Vue 3.
- Create a product list page that fetches the list of products from the back-end API and displays them in a grid or list view.
- Create a product detail page that shows the image, title, description, and price of a selected product.
- Implement functionality to add products to the cart and display a notification or feedback to the user.

### Backend
- Install Laravel using composer and set up a new Laravel project.
- Create a Product model and migration to represent the products in the database.
- Set up Laravel API routes for handling product-related CRUD operations (e.g., fetching products, adding products to the cart).
- Implement the necessary controller methods to handle the API requests from the front-end and interact with the database.
- Use Laravel's built-in authentication or a third-party package for authentication and authorization, if required for additional features such as cart management.

### Inertia.js Integration
- Install Inertia.js in the Laravel project using composer and configure it to work with Vue.js.
- Use Inertia.js to handle API requests and responses between the front-end and back-end, allowing you to write server-side code in Laravel and client-side code in Vue without having to create a separate API.
- Define Inertia.js shared data and props to pass data from the back-end to the front-end components, such as the product list and product detail pages.
- Use Inertia.js's page components to define the Vue components for the front-end views, and use Laravel's routes and controllers to handle the corresponding API requests.

## Testing
- Write unit tests and/or feature tests for the  components, Vuex store, and Laravel controllers and API routes using testing frameworks such as Jest, Vue Test Utils, and Laravel's built-in testing features.
- Test various scenarios such as adding products to the cart, retrieving cart data, and handling errors to ensure the reliability and quality of the code.
- Incorporate mock data and mock API requests using libraries such as Axios Mock Adapter or Laravel's built-in HTTP testing features to simulate API responses and test different scenarios.


### Code Organization and Best Practices
- Follow best practices for code organization, such as separating concerns into components, using Vuex for state management if necessary, and structuring the Laravel controllers and routes logically.
- Write clean, maintainable, and testable code, following coding standards and Laravel and Vue.js best practices.
- Implement unit tests and/or feature tests to ensure the reliability and quality of the code.
- Document the code, including any installation instructions, usage instructions, and any design/architectural patterns used in project.
- Consider implementing error handling, validation, and security measures to protect against potential security risks and enhance user experience.

## **Api Endpoints:** 🍡
### Retrieve List of Products:
- `GET /api/products`
- Fetches the details of a specific product based on the product ID from the database and returns them as props to be used in a Vue component.
- It would be defined a method that fetches the products from the database using the Product model and passes them as props to a Vue component using the inertia helper. You can use Laravel's query builder or Eloquent ORM to query the database and retrieve the products based on the data model. In the Vue component, I can access the props and render the list of products.

### Retrieve Product Detail:
- `GET /api/products/{id}`
- Fetches the details of a specific product based on the product ID from the database and returns them as JSON response
- it would be defined a method that fetches the product details from the database based on the product ID, using the Product model or Eloquent ORM, and returns them as an API resource or plain JSON response.

### Add Product to Cart:
- `POST /api/cart/store`
- Adds a product to the cart for the currently authenticated user
- It would be defined a method that receives the product ID and quantity as input from the request, validates the input, and adds the product to the cart for the authenticated user. You can use Laravel's built-in authentication middleware to ensure that only authenticated users can add products to the cart, and I can use Laravel's session or a persistent storage such as the database to store the cart data

### Retrieve Cart Data:
- `GET /api/cart`
- Fetches the cart data for the currently authenticated user and returns them as JSON response
- It would be defined a method that fetches the cart data for the authenticated user, retrieves the cart items from the session or persistent storage, and returns them as an API resource or plain JSON response.

### Manage Cart Items
- `PUT /api/cart/{id}`
-  Updates the quantity of a specific cart item for the currently authenticated user, or removes the cart item if the quantity is set to 0
-  It would be define a method that receives the cart item ID and quantity as input from the request, validates the input, and updates the quantity of the cart item in the cart data for the authenticated user. If the quantity is set to 0, you would remove the cart item from the cart data.

## **Other features or functionalities:** 🙏
- Search and Filtering: Implement a search functionality that allows users to search for products based on keywords, categories, or other criteria. You can also add filtering options, such as sorting by price, rating, or popularity, to help users narrow down their product selection.
- User Authentication and Authorization: Implement user authentication and authorization to allow users to create accounts, login, and manage their profiles. You can use Laravel's built-in authentication system to handle user registration, login, and password reset. You can also implement role-based authorization to control access to certain features or functionalities based on user roles, such as allowing only authenticated users to add products to their cart.
- Order History and Tracking: Implement an order history and tracking functionality that allows users to view their past orders, track the status of their current orders, and receive notifications about their order status updates.
- User management, Product management
- Permission & Role management
- Theme can be changed

## **Command to execute the project:** 🥖
### Server-Side

```
composer install

cp .env.example .env

php artisan cache:clear

composer dump-autoload

php artisan key:generate

composer require laravel/breeze --dev

php artisan breeze:install vue --inertia

php artisan serve
```

### Database

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fixform
DB_USERNAME=root
DB_PASSWORD=
```

### Migrate

```
php artisan migrate

php artisan db:seed
```

### Server-Side

```
npm i

npm run dev
```
