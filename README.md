# Pairfony

[Pairfony.com](http://pairfony.com) is **the** place where passionate PHP developers of all levels come to meet to
perfect their craft.

If you want to meet other professionals that care about well-crafted software, you've come to the right place!

[![Build Status](https://travis-ci.org/marcaube/Pairfony.png?branch=master)](https://travis-ci.org/marcaube/Pairfony)


## Installation

### 1. Clone the repo to a local folder

```bash
$ git clone https://github.com/marcaube/Pairfony.git
```


### 2. Configure

Copy `config/parameters.yml.dist` to `config/parameters.yml` and edit according to your database settings.

Also, since the app uses Github OAauth service for authentication, you'll need to [create a Github app]
(https://github.com/settings/applications/new). Use your local URL for the callback.

Once you created your dev app on Github, copy the client id and client secret to your `parameters.yml`.


### 3. Install the dependecies using composer

```bash
$ curl -sS https://getcomposer.org/installer | php
$ composer install
```


### 4. Create the database and tables

```bash
php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:create
```


### 5. Install the static assets

```bash
php app/console assets:install web
php app/console assetic:dump
```


## Requirements

- PHP >= 5.3


## Contributing

See the [CONTRIBUTING.md](CONTRIBUTING.md) file.


## Running the tests

Install the dev dependencies with composer:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ composer install --dev
```

Run the test suite with phpunit:

```bash
$ phpunit -c app/
```

You can also check for code coverage:

```bash
$ phpunit -c app/ --coverage-text
```


## License

Pairfony is released under the MIT License. See the bundled [LICENSE](LICENSE) file for details.
