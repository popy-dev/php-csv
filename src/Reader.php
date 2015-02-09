<?php

namespace Popy\Csv;

use Iterator;
use Popy\Csv\Exception\ReadException;

/**
 * CSV Reader interface
 */
interface Reader extends Csv, Iterator {
    /**
     * {@inheritDoc}
     *
     * @throws ReadException If an error occurs while reading the CSV
     */
    //public function rewind();
    
    /**
     * {@inheritDoc}
     *
     * @throws ReadException If an error occurs while reading the CSV
     */
    //public function next();
}