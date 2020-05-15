<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

# Foobar

Watchbase is video library website developed on Laravel. This small project was done as an assignment for Web Engineering course at my university.

## Project Setup Instructions

Laravel Video Library Assignment Setup

1. Clone the repo:

```bash
git clone https://github.com/aswaddev/watchbase.git
```

2. Open the newly created folder with name "watchbase" and run the following commands there

```bash
cd watchbase
```

3. Install Laravel dependencies:

```bash
composer install
```

4. Create .env file using .env.example

```bash
cp .env.example .env
```

5. Configure your database in the newly created .env file
6. Run migrations:

```bash
php artisan migrate
```

7. Create storage symlink:

```bash
php artisan storage:link
```

8. Create application key:

```bash
php artisan key:generate
```

9. Run the server:

```bash
php artisan serve
```

Now the project setup is complete. It should work just fine but since it's a fresh setup, the project won't have any data so you will have to register a user and then you should be able to create categories and add videos to those categories

## License

[MIT](https://choosealicense.com/licenses/mit/)
