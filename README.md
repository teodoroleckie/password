# PHP password manager - Password hash validator / password requirements validator
Password hash validator / password requirements validator 

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/teodoroleckie/password/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/teodoroleckie/password/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/teodoroleckie/password/badges/build.png?b=main)](https://scrutinizer-ci.com/g/teodoroleckie/password/build-status/main)
[![Total Downloads](https://img.shields.io/packagist/dt/tleckie/password.svg?style=flat-square)](https://packagist.org/packages/tleckie/password)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/teodoroleckie/password/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)


### Installation

You can install the package via composer:

```bash
composer require tleckie/password
```

### Usage

### Register user in database:

```php

require_once "vendor/autoload.php";

use Tleckie\Password\Validator;
use Tleckie\Password\Requirements;

$passwordManager = new Validator();

$validatePasswordForRegistration = 'Secure123.Validator';

//Check if the password meets the requirements to store it.
$passwordManager->isValid($validatePasswordForRegistration); // true

// You can customize the password requirements
$requirements = new Requirements(10, false, true, false, true);
$passwordManager = new Validator($requirements);

// Generate the hash to be stored in the database (user|hash).
$storeInDataBase = $passwordManager->createHash($validatePasswordForRegistration);
// User registration completed!
```

### Login:

```php

require_once "vendor/autoload.php";

use Tleckie\Password\Validator;

$passwordManager = new Validator();

// Find the user when logging in.
$loginPassword = 'Secure123.Validator';
$databaseUserHash = '$2y$08$WiqPWg.Gkd1CPVpCn/izl.DxhAeJCeo8SVpV03vBCb04.OgMEF81m';

// We verify the hash stored in the database with the login passwords
$passwordManager->passwordVerify($loginPassword, $databaseUserHash); // true

// That's all! I hope this helps you
```