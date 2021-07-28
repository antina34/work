# Bitcoin price prediction shop

<p>
    <a href="https://www.php.net/releases/7_2_5.php">
        <img src="https://www.php.net/images/logos/php-logo.svg" alt="7.2.5" width="10%"/>7.2.5
    </a>
    <a href="https://nodejs.org/en/blog/release/v12.16.2/">
        <img src="https://nodejs.org/static/images/logo.svg" alt="12.16.2" width="9%"/>12.16.2
    </a>
    <a href="https://dev.mysql.com/doc/relnotes/mysql/5.7/en/news-5-7-29.html">
        <img src="https://cdn.worldvectorlogo.com/logos/mysql.svg" alt="5.7.29" width="11%">5.7.29
    </a>
</p>

## To set up the project on Docker

1. Clone the repository.
2. Run `cd mybitcoin`.
3. Run `docker-compose up`. (Docker must be installed)

## To set up the project on Laravel Homestead:

1. Clone into a repository, copy .env.example to .env and set the db connection details

2. Run `composer install && npm install && php artisan key:generate && php artisan deploy && npm run dev`

3. Go to the defined path for example `mybitcoin.test` to view the project

    * User email: `user@mybitcoin.ai` User Password: `us3rus3r`
    
    * Admin email: `admin@mybitcoin.ai` Admin Password: `adm1nadm1n`

## Development Workflow

Refer the wiki page in https://gitlab.beehub.dev/mbtc/mybitcoin/-/wikis/home named `Working with features - Step by step guide`.
