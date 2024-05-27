# crud--ddd-test

1. Install dependencies

```bash
composer install && npm install
```

2. Copy .env.example and generate app key

```bash
cp .env.example .env && php artisan key:generate
```

3. Migrate the database

```bash
php artisan migrate
```

4. Run the application

```bash
php artisan serve
npm run dev
```



### Further development
1. Do the TODOs

2. Put swagger codes for schemas in resources and requests classes.

3. Rename domain name from "Name" to actual name
