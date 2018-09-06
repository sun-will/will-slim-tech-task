> ### Tech Task that utilize Php Slim Framework that implements the specs given and adheres to [Object Oriented Programming](https://en.wikipedia.org/wiki/Object-oriented_programming#Features) and [Solid Principles of OOP](https://en.wikipedia.org/wiki/SOLID).

This codebase was created to fulfill the tech task given that implements a micro php framework like **[Slim](https://www.slimframework.com/)** to fetch Twitter tweets of a given handle name and process the data to determine how many tweets the user had per hour per day via **[Twitter Developer API](https://developer.twitter.com/content/developer-twitter/en.html).

For more information how it works head over to [Repo](https://github.com/sun-will/will-slim-tech-task) repo.

* [Getting Started](#getting-started)
  * [Pre-requisites](#pre-requisites)
  * [Installation](#installation)
     * [Dependencies](#dependencies)
     * [Environments Variables](#environments-variables)
     * [Run Application](#run-application)
     * [Run Test](#run-test)
* [Code Overview](#code-overview)
  * [Design Architecture](#design-architecture)
     * [Code Design](#code-design)
  * [Request-Response Cycle](#request-response-cycle)
* [Future Improvement](#futurer-improvement)

# Getting Started
## Pre-requisites
Make sure to have [PHP >=7.0](https://www.techandme.se/install-php-7-on-ubuntu-14-04/), [composer](https://poweruphosting.com/blog/install-composer-ubuntu/) installed on your machine.

## Installation
> Start by cloning the repository into your local machine.
```bash
git clone https://github.com/sun-will/will-slim-tech-task
cd will-slim-tech-task
```

### Dependencies 
This app is built using **[Slim](https://www.slimframework.com/)**, and some extra packages used by the app that must be further installed.
> Install Dependencies
```bash
composer install
```
**List of Dependencies**
- [respect/validation](http://respect.github.io/Validation/) Validate the request parameters.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) To load environment variables from `.env` file.
- [phpunit/phpunit](https://phpunit.de/) Testing Framework.
- [abraham/twitteroauth](https://github.com/abraham/twitteroauth) Twitter OAUTH.

### Environments Variables
The command `composer install` will copy .env.will to `.env` which should have your own variables.

### Run Application
Run the application by running the following command:
```bash
composer start
```
This command will spin a local php server which is enough for testing.
To verify, you can check the api by visiting [http://localhost:8080/](http://localhost:8080/)
Test Cases:
1. [http://localhost:8080/](http://localhost:8080/)
2. [http://localhost:8080/hello/will/](http://localhost:8080/hello/will/)
3. [http://localhost:8080/histogram/ufc/](http://localhost:8080/histogram/ufc/)

### Run Test
To run test enter the following command:
```bash
composer test
```
This will run phpunit test for all functional API endpoints.

# Code Overview
## Design Architecture
### Code Design
The code utilizes the MVC pattern where requests are redirected to a controller to process the request and returned a JSON response.

## Request-Response Cycle
All requests go through the same cycle:  `routing > middleware > conroller > response`

# Future Improvement
Due to time constraint and irrelevance to the functional requirements, the author forego the implementation of both [jwt auth](https://github.com/tuupola/slim-jwt-auth) and [cors](https://www.slimframework.com/docs/v3/cookbook/enable-cors.html) for security.  Both are nice additional for a full fledge API but this current state of the application doesn't call for it (yet).
