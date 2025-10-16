# Hospital Management System


## Installation

To install the HMS , follow the steps below:

1. Clone the repository to your desired directory:

    ```
    cd /path/to/Hospital-Management-Using-Laravel-Filamentphp
    ```

2. Run the following command to install the required packages:

    ```
    npm clean-install
    composer install
    ```

## First Time Installation Only

If you are installing HMS  for the first time, you will need to run the following additional steps:

1. Copy the example environment file and create a new `.env` file:

    ```
    cp .env.example .env
    ```

2. Generate an application key:

    ```
    php artisan key:generate
    ```

3. Run the database migrations and seed the database with initial data:

    ```
    php artisan migrate:fresh --seed
    ```

    **NOTE:** The `migrate:fresh` command destroys all data in the database. Do not run this command in a production environment.

4. Create a symlink between storage and public folder to access media assets:

    ```
    php artisan storage:link
    ```
    **NOTE:** If a different port is used other than the default one, then alongwith the main url mention the port number in APP_URL in the .env file.


## Run Development Environment

To start the development server, run the following command:

```
php artisan serve
```

Then, run the following command to compile the front-end assets:

```
npm run dev
```

## Upgrade Filament

To upgrade Filament, run the following commands:

```
php artisan config:clear
php artisan livewire:discover
php artisan route:clear
php artisan view:clear
```

```
composer update
php artisan filament:upgrade
```

## Run Cypress Test

To run the Cypress test suite, run the following command:

```
npx cypress open
```

