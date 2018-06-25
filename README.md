# Simple Full-stack Application.

## Server

Simple PHP Framework-based API as front-end to a database and minor server processing.

### Requirements

 - PHP v7.1 or higher (https://secure.php.net/)
    + MacOS usually has this built in, but check using `php -v`.
    + Ensure that the Sqlite PDO driver is enabled.
 - Composer (https://getcomposer.org/)
    + Use the package manager for your system instead of installing from the website. For MacOS: `brew install composer`, For Linux: `apt install composer`. 

### Using

 1. `cd` into the `server/` directory. 
 2. Run the `composer install` command. The `vendor/` directory will be created.
 3. Duplicate the `.env.example` file, and rename to `.env`. 
 4. Create the SQLite file inside the `server/` directory. Name it `database.sqlite`.
 5. Open the newly created `.env` file and paste the *absolute path* if your `database.sqlite` file into the `DB_DATABASE` variable (between the quotes).
 6. run `php -S localhost:8000`.
 7. navigate to `http://localhost:8000/`

## Client

A basic HTML5/JavaScript browser application. 

### Requirements

 - Yarn Package Manager (https://yarnpkg.com)

### Using

1. `cd` into the `client/` directory. 
2. run `yarn install`.
3. Open the `index.html` file in a browser.
