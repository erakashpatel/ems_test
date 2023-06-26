

## clone the project 

clone the project 

``git clone https://github.com/erakashpatel/ems_test.git``


Or you can download it manually

Go to project folder

``cd ems_test``

Install dependencies

Create .env file from .env.example file. Then change the below variable value according to your value.

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-_db_ame
DB_USERNAME=your_db_user_name
DB_PASSWORD=your_db_password
QUEUE_CONNECTION=database

```


```bash
composer install
```

Then setup the database Migration Tables & Entrymode, Module seeder file (This command will execute all required commands as a sequence)

```bash
php artisan migrate --seed
```

```bash
php artisan serve
```

For Queue work also need to run 

```bash
php artisan queue:work --queue=high,default
```


Thank you for trust my ability. I am looking forward to work with you.

Thank you :)