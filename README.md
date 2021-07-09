# ServerTime - be sure you have a correct server time

Helper class for getting server date and time by server IP address

## Setup

### Composer manually installation

Pull this package in through Composer

```json
{
    "require": {
        "andrii-trush/server-time": "^1.0.0"
    }
}
```

```sh
composer update
```


### Composer automatically installation

```sh
composer require andrii-trush/server-time
```

## Examples

Helper uses public IP of the server by default.

```php
<?php 

use AndriiTrush\ServerTime\ServerTime;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor'. DIRECTORY_SEPARATOR . 'autoload.php';

$dateTime = ServerTime::getDateTime();
```

Method `getDateTime` has optional param ``$ip`` as string, to specify server IP address manually


```php
<?php 

use AndriiTrush\ServerTime\ServerTime;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor'. DIRECTORY_SEPARATOR . 'autoload.php';

$dateTime = ServerTime::getDateTime('8.8.8.8');
```

Method `getDateTime``` returns an object ``DateTime`` which implements interface ``DateTimeInterface`` 
