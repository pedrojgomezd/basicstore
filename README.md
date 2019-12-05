# Welcome to Basic Store
## Demo [Basicstore](https://basicstore.herokuapp.com)
## Credentials
|User|Password  |
|--|--|
| admin@basicstore.com | admin |

## Installation instruction

#### Clone the repositories and install dependency

    git clone https://github.com/pedrojgomezd/basicstore.git
    cd basicstore
    composer install

### Add a copy of .env.example and modify the environment variables
    cp .env.example .env
   
##### Environment variables that you should not ignore
    DB_DATABASE
    DB_USERNAME
	DB_PASSWORD
    APP_URL
##### NOTE: The variables that refer to the PlacetoPlay api are already registered

###   Generate encryption key

    php artisan key:generate

### Run migrations with seeder seeder

Migrations and the seeder must be executed, in order for an admin user to create.

    php artisan migrate --seed
### Flow
##### Customer

    Langind -> Button [I want it!]
    	if (Login custmoer)
            purchase detail
        else
            Formulario de login o registro
        
    Deailt
        if(Status is not payed)
            Show Button[Payment]
        else
            Show[Pagado]
    Purchases
	      Customer's shopping list with the states

##### Admin
	Dashboard
		if(Login user)
			Show List all store purchases
		else
			Form login

### Note
The routes of the application would look like this
#### Customer Routes
[Landing](http://localhos/)

[Login](http://localhos/login)

[Register](http://localhos/register)

[Purcahses](http://localhos/purcahses)

[Purcahses/{purchase}](http://localhos/purcahses/1)


#### Admin Route
[Login](http://localhos/admin/login)
[Dashboard](http://localhos/dashboard/)
