## PHP StringBuilder
#### Port of Java StringBuilder
### Installation
```bash
$ composer require dmasior/string-builder
```
### Usage
#### Instantiation
```php
use Dmasior\StringBuilder\Builder;

// new instance via new
$builder = new Builder('Hi!');

// new instance via create method
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
