<?php

namespace Popy\Csv\Exception\DataReader;

use RuntimeException;
use Popy\Csv\Exception\DataReadException;

/**
 * Read operation exception raised by NamedColumnReader.
 */
class SplFileObjectException extends RuntimeException implements DataReadException
{
}
