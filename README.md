# rewarding-system-cs313
Rewarding system school project

### How to Set Up the Project - Backend

Follow these steps to set up the project:

1. **Install PHP dependencies**:

   ```bash
   composer install
   ```

2. **Install Node.js dependencies and build the frontend**:

   ```bash
   npm install && npm run build
   ```

3. **Run database migrations and seed the database**:

   ```bash
   php artisan migrate:fresh && php artisan db:seed
   ```
