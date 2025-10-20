# Products CRUD

## Requirements
- git
- docker
- docker-compose

## Configuration locally
Create a new enviroment file.

```sh
cd products-crud
cp .env.example .env
```

Install the dependencies.

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install
```

Run the containers
```sh
./vendor/bin/sail up -d
```

Generate a new key for the application
```sh
./vendor/bin/sail artisan key:generate
```

### Database
Run migrations
```sh
./vendor/bin/sail artisan migrate
```

Run seeder for Players
```sh
./vendor/bin/sail artisan db:seed --class=ProductSeeder
```

By default, the API must be running in localhost:80

## API Docs

| **Endpoint**         | **Method** | **Description**            | **Request Body**                                                           | **Response (200)**                                                                    |
| -------------------- | ---------- | -------------------------- | -------------------------------------------------------------------------- | ------------------------------------------------------------------------------------- |
| `/api/products`      | `GET`      | Get all products           | –                                                                          | `[{ "id": 1, "name": "Product 1", "price": 100.5, "stock": 10, "status": "active" }]` |
| `/api/products/{id}` | `GET`      | Get a single product by ID | –                                                                          | `{ "id": 1, "name": "Product 1", "price": 100.5, "stock": 10, "status": "active" }`   |
| `/api/products`      | `POST`     | Create a new product       | `{ "name": "Product 1", "price": 100.5, "stock": 10, "status": "active" }` | `{ "id": 1, "name": "Product 1", "price": 100.5, "stock": 10, "status": "active" }`   |
| `/api/products/{id}` | `PUT`      | Update an existing product | `{ "name": "New name", "price": 120.0, "stock": 5, "status": "inactive" }` | `{ "id": 1, "name": "New name", "price": 120.0, "stock": 5, "status": "inactive" }`   |
| `/api/products/{id}` | `DELETE`   | Delete a product by ID     | –                                                                          | `{ "message": "Product deleted successfully" }`                                       |



## Tests
```sh
./vendor/bin/sail artisan test
```