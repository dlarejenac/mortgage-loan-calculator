## Mortgage Loan Calculator
A web appplication that calculates monthly payments, generates amortization schedules and displays the effective interest rate based on real cash flows.

## Requirements
- PHP^8.1+
- Composer
- MySQL
- Node.js & npm (Tailwind CSS & Flowbite)
- Laravel^10.x
- PHPUnit
- markrogoyski/math-php (IRR)

## Setup Instructions
**1. Clone the Repository**
```bash
git clone https://github.com/dlarejenac/mortgage-loan-calculator.git

cd mortgage-loan-calculator
```
**2. Install PHP Dependencies**
```bash
composer install
```
**3. Generate Key**
```bash
php artisan key generate
```
**4. Run Migrations**
```bash
php artisan migrate
```
**5. Install Node Modules (for Tailwind & Flowbite)**
```bash
npm install
```
**6. Install Tailwind CSS & Flowbite**
If needed, install manually:
```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
npm install flowbite
```
Then edit tailwind.config.js:
```js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
```
And in resources/css/app.css:
```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@import "flowbite";
```
**7. Compile Assets**
```bash
npm run dev
```
**8. Run the Application**
```php artisan serve```
Visit http://127.0.0.1:8000

## Running Tests
To run all feature and unit tests:
```bash
php artisan test
```
