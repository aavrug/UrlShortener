# URLShortener

URLShortener will ask for two URLs and provide a single short URL. The navigation will happen as per your device type(Desktop/Mobile view).

## Setup

Clone UrlShortener or download it.

Install [composer](https://getcomposer.org/doc/00-intro.md)

Go to the UrlShortener directory and run
```
    composer install
```
## Configuration

Rename or copy  ".env.example" file and create a new .env file in the same location where ".env.example" is.
Configure ".env" as per your database configuration and create a database with the same name that configures.
Add random string or just add "base64:NX7XipHmmniH3WD4YTS224UsFZ+dWASBhNhVp0hcFhE=" to "APP_KEY" in ".env"
Now run
```
    php artisan migrate
    php artisan serve
```

Open given localhost URL to your browser and add any URL.

## API

For getting all records
```
    curl http://<localhost:8000/your URL>/api/v1/urls
```

For creating a new record
```
    curl -i -X POST -H "Content-Type:application/json" http://<localhost:8000/your URL>/api/v1/urls -d '{"desktop_url":"<Desktop URL>", "mobile_url":"<mobile URL>"}'
```

## Tests

To run the tests
```
    ./vendor/bin/phpunit
```

## Use

Just open your browser and use the current running URL and type
```
    http://<localhost:8000/your URL>/switch/<Provided short string for your entered URL>
```
