<?php

namespace Popy\Csv\Writer;

use Traversable;
use Popy\Csv\Writer;
use Popy\Csv\AbstractCsv;
use Popy\Csv\Exception\InvalidInputRow;

/**
 * CSV Reader interface
 */
abstract class AbstractWriter extends AbstractCsv implements Writer {
    /**
     * {@inheritDoc}
     */
    public function appendRow($row)
    {
        if (is_array($row)) {
            // Nothing to do
        } elseif ($row implements Traversable) {
            $row = iterator_to_array($row);
        } else {
            throw new InvalidInputRow($this, $row);
        }

        $this->doAppendRow($row);

        return $this;
    }

    /**
     * Appends an array as a new row into the CSV
     * 
     * @param  array  $row Input row
     */
    protected function doAppendRow(array $row);
}