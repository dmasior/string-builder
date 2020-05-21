## PHP StringBuilder
### Port of Java StringBuilder
### Usage
```php
use Initx\StringBuilder\Builder;

$builder = new Builder('Hello ');

$builder->append(" world");

echo $builder->toString(); // Hello world
```
