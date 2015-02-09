<?php

namespace Popy\Csv;

use Traversable;
use Popy\Csv\Exception\WriteException;

/**
 * CSV Writer interface
 */
interface Writer extends Csv {
    /**
     * Appends a row at the end of the CSV file
     * 
     * @param  array|Traversable $row [description]
     *
     * @throws WriteException if a problem occurs
     * @return self
     */
    public function appendRow($row);
}