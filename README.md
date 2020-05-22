## PHP StringBuilder
#### Port of Java StringBuilder
### Installation
```bash
$ composer require dmasior/string-builder
```
### Usage
Via new
```php
use Dmasior\StringBuilder\Builder;

$builder = new Builder('Hello');
$builder->append(' world');

$builder->toString(); // "Hello world"
```
Via create method
```php
use Dmasior\StringBuilder\Builder;

$builder = Builder::create('Hello')
    ->append(' world');

$builder->toString(); // "Hello world"
```
#### Insert
```php
$builder->insert(0, '123')
    ->insert(3, '456');

$builder->toString(); // "123456"
```
#### LastIndexOf
```php
$builder->append('123abc123abc');

$builder->lastIndexOf('123'); // 6
```
#### Reverse
```php
$builder->append('4321');

$builder->reverse()
    ->toString(); // "1234"
```
