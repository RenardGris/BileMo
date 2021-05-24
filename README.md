# BileMo project

## Project

### Presentation
This project was made during my apprenticeship in programming
This is a symfony API around a btob business, 
we propose a list of phones to our users,
and they can then offer to their client. 
Only register and logged user can have access to the api, 
a jwt is required to request resources. 

### Features
For products :
- Get a collection of products
- Get details of product
  
For Customers (according to the current logged user) :
- Get a collection of customers
- Get details of a customer
- Post a new customer
- Put a customer
- Delete a customer

For Users : 
- Login (return a JWT)
- Show details

### Documentation (swagger)

Want to read the swagger documentation ?
Use the next request to see a beautiful ui of the documentation.
```
http://YourLocalHost/swagger/
```

## Installation

1.  get project from repository
```
git clone https://github.com/RenardGris/BileMo.git
```

2.  install dependency
```
composer install
```

3.  Make a copy of .env.default and rename it .env.

- 3.1 Define the DATABASE_URL according to yours
``` 
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
# DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.4.10"
# DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
```
- 3.2 Remember to also change the jwt passphrase
``` 
JWT_PASSPHRASE=YOURCUSTOMPASSPHRASE
```

4.  Next, you can run the next command line :
- 4.1 create database
``` 
 php bin/console doctrine:database:create
```
- 4.2 create tables
``` 
 php bin/console doctrine:migrations:migrate
```
- 4.3 fill tables with fake data
``` 
 php bin/console doctrine:fixtures:load
```

5. Create ssl keys for the generation of jwt token
```
 php bin/console lexik:jwt:generate-keypair   
```