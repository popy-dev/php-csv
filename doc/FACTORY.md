# Factory & Builder
The factory is intended to ease the usage/instanciation of CSV classes. As this library is composed of many wrappers, it could become tedious to have to instanciate a Reader and 2 or 3 more to wrap it. Builder goes a step further by allowing to chain factory calls without having to give the original reader at each step.

For instance :
```php
<?php

use SplFileInfo;
use Popy\Csv\Reader\SplFileInfoReader;
use Popy\Csv\Reader\CharsetConverterReader;
use Popy\Csv\Reader\AutoNamedColumnReader;

$file = new SplFileInfo('/path/to/file.csv');
$reader = new SplFileInfoReader($file);
$reader = new CharsetConverterReader($reader, 'Windows-1252', 'UTF-8');
$reader = new AutoNamedColumnReader($reader);

foreach ($reader as $key => $value) {
  // ...
}

```

becomes
```php
<?php

use Popy\Csv\Factory\ReaderFactory;

$factory = new ReaderFactory();

$reader = $factory->getBuilder()
    ->fromFile('/path/to/file.csv')
    ->charsetConvert('Windows-1252', 'UTF-8')
    ->autoNameColumns()
    ->build()
;

foreach ($reader as $key => $value) {
  // ...
}

```

## ReaderFactory methods

*Please note that ReaderBuilder methods are the same than Factory method, without the first "Reader $reader" argument.*

- getBuilder()
- fromFile(string|SplFileInfo $input) 
- fromString(string $input)
- fromStream(resource $input)
- charsetConvert(Reader $reader, string $from, string $to)
- nameColumns(Reader $reader, array $columns)
- autoNameColumns(Reader $reader)