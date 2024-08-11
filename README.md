<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel Joke App

This app is all about having fun! Enjoy and let the good times roll!

## Table of Contents

- [About](#about)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)

## Installation

Follow these steps to set up the application on your local environment:

1. **Clone the Repository**

    ```bash
    git clone https://github.com/izzettingucum/laravel-joke-app.git
    ```

2. **Install Dependencies**

    ```bash
    cd laravel-joke-app
    composer install
    ```

3. **Copy the Environment File**

    ```bash
    cp .env.example .env
    ```

4. **Generate the Application Key**

    ```bash
    php artisan key:generate
    ```

5. **Configure the Database**

   Open the `.env` file and set up your database configurations.

6. **Run Database Migrations**

    ```bash
    php artisan migrate
    ```

7. **Start the Application**

    ```bash
    php artisan serve --host=localhost
    ```

   Your application should now be running at [http://localhost:8000](http://localhost:8000).

## Usage

To start using the web application, visit [http://localhost:8000](http://localhost:8000)

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/FeatureName`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push your branch (`git push origin feature/FeatureName`).
5. Open a Pull Request.
