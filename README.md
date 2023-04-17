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
- Tailwind 3.0
- Inertia.js
### BackEnd
- Laravel 8.0
- Laravel Eloquent
- Laravel Sanctum
- MySql or PostgreSQL
### Other Libraries
- Vue Test Utils
- Laravel Mix
- PHPUnit
- Laravel Dusk
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
- Test various scenarios such as adding products to the cart, retrieving cart data, and handling errors to ensure the reliability and quality of  code.
-

### Code Organization and Best Practices
- Follow best practices for code organization, such as separating concerns into components, using Vuex for state management if necessary, and structuring the Laravel controllers and routes logically.
- Write clean, maintainable, and testable code, following coding standards and Laravel and Vue.js best practices.
- Implement unit tests and/or feature tests to ensure the reliability and quality of the code.
- Document the code, including any installation instructions, usage instructions, and any design/architectural patterns used in project.
- Consider implementing error handling, validation, and security measures to protect against potential security risks and enhance user experience.

