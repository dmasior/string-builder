## PHP StringBuilder
#### Port of Java StringBuilder
### Installation
```bash
$ composer require [..]
```
### Usage
#### Append
```php
use Dmasior\StringBuilder\Builder;

$builder = new Builder();

$builder->append('Hello')
    ->append(' world');

$builder->toString(); // Hello world
```
