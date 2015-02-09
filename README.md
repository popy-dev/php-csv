# What is php-csv ?
It is a fully object-oriented CSV reading (soon writing) toolkit, providing various classes to ease CSV file manipulations

## Installation

php composer.phar require popy-dev/php-csv:dev-master

## Basic usage
```php
<?php

use Popy\Csv\Reader\SplFileInfoReader;

$file = new SplFileInfo('/path/to/file.csv');
$reader = new SplFileInfoReader($file);

foreach ($reader as $key => $value) {
  // ...
}
```

## Dealing with Microsoft encodings ?
```php
<?php
use Popy\Csv\Reader\CharsetConverterReader;

$rawReader = ...; // Initialize any reader you want (SplFileInfoReader for instance)
$reader = new CharsetConverterReader($rawReader, 'Windows-1252', 'UTF-8');

foreach ($reader as $key => $value) {
  // ...
}

```

## Want named columns ?
### Fixed column headers
```php
<?php
use Popy\Csv\Reader\NamedColumnReader;

$rawReader = ...; // Initialize any reader you want (SplFileInfoReader for instance)
$reader = new NamedColumnReader($rawReader, array('col1', 'col2'));

foreach ($reader as $key => $value) {
  // ...
}
```

### Alternative : Use first row as column names
```php
<?php
use Popy\Csv\Reader\AutoNamedColumnReader;

$rawReader = ...; // Initialize any reader you want (SplFileInfoReader for instance)
$reader = new AutoNamedColumnReader($rawReader);

foreach ($reader as $key => $value) {
  // ...
}
```
