## About
REST API for a directory listing of practitioner profiles.

## Install Repository
```
composer update
```

## Migrate Tables
```
php artisan migrate
```

## Run Seeders
```
php artisan db:seed
```

## Routes
```
/pratitioners/get/{page}/{limit} - returns API list of practioners
```

API list of practioners' Parmeters
```
?name={practioner name or title}
?category_id={category id}
?location_id={location id}
?sort={ASC or DESC - order by practitioners id}
```
CRUD Routes
```
/pratitioners/create - adds practioner profile details
/pratitioners/update - adds practioner profile details
/pratitioners/delete - adds practioner profile details
```

Kinldy make sure that a valid api_token is inclulded as a query paramter to be able to perform CRUD operations
List of api_token per user can be found under users table


