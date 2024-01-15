# Yeezy Rest

A simple HTTP API to receive kanye west quotes the way they always should be - in batches of 5, and from a cache.

---
## Installation

The following instructions assume you have a working PHP dev setup, using Laravel Herd.

Clone this repository to a suitable herd folder on your computer.

```bash
git clone https://github.com/audiojames/yeezy-rest.git
```

Create an env file

```bash
cp .env.example .env
```

Generate an application key

```bash
php artisan key:generate
```


## Usage
First, Generate an API token

```bash
php artisan create:token
```

The output from the command will look something like this, showing your newly generated token.
```php
Your API Key is: XXX-XXXX-XXXX
```

You can use this key to make requests to the two endpoints available.  Responses will be a JSON Array:

The Quotes endpoint, to receive 5 quotes.
```bash
http://yeezy-rest.test/api/quotes?token=YOUR_TOKEN_HERE
```

The Fresh Quotes endpoint, to receive the 5  absolute freshest quotes from Yeezus himself.
```bash
http://yeezy-rest.test/api/fresh-quotes?token=YOUR_TOKEN_HERE
```

## Testing

The following command will run the application test suite

```bash
php artisan test
```

