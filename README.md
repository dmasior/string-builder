## 👷 StringBuilder for PHP
[![Build Status](https://travis-ci.org/dmasior/string-builder.svg?branch=master)](https://travis-ci.org/dmasior/string-builder)

Mutations over sequence of characters.

### ✔️ Requirements
- PHP 7.2+

Suggestions
- ext-mbstring for multibyte support
#### Installation
```bash
$ composer require dmasior/string-builder
```
### ⌨️ Usage
#### Instantiation
```php
use Dmasior\StringBuilder\Builder;

// Via new
$builder = new Builder('Hi!');

// Via create method
$builder = Builder::create('Hi!');
```
#### Append
```php
$builder->append('Hello')
    ->append(' world');

$builder->toString(); // "Hello world"
```
#### Insert
```php
$builder->insert(0, 'Hello')
    ->insert(5, ' world');

$builder->toString(); // "Hello world"
```
#### Delete
```php
$builder->append('1234567')
    ->delete(5, 7);

$builder->toString(); // "1234"
```
#### DeleteCharAt
```php
$builder->append('12345')
    ->deleteCharAt(5);

$builder->toString(); // "1234"
```
#### IndexOf
```php
$builder->append('123abc123abc');

$builder->indexOf('123'); // 0
```
#### LastIndexOf
```php
$builder->append('123abc123abc');

$builder->lastIndexOf('123'); // 6
```
#### Reverse
```php
$builder->append('4321')
    ->reverse()
    ->toString(); // "1234"
```
#### Length
```php
$builder->append('1234')
    ->length(); // 4
```
#### Substring
```php
$builder->append('012345')
    ->substring(1, 3); // "123"
```
#### CharAt
```php
$builder->append('123')
    ->charAt(1); // "2"
```

