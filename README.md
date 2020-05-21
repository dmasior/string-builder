## PHP StringBuilder
#### Port of Java StringBuilder
### Installation
```bash
$ composer require [..]
```
### Usage
#### Append
```php
use Initx\StringBuilder\Builder;

$builder = new Builder('Hello ');

$builder->append(" world");

$builder->toString(); // Hello world
```
