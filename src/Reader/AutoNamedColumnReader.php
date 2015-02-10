<?php

namespace Popy\Csv\Reader;

use Popy\Csv\Reader;

/**
 * AutoNamedColumnReader : wraps a CSV reader and uses the first row as header list
 */
class AutoNamedColumnReader extends NamedColumnReader
{
    /**
     * Class constructor
     * 
     * @param Reader $reader Wrapped CSV reader
     */
    public function __construct(Reader $reader)
    {
        $this->internal = $reader;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->internal->rewind();

        if ($this->internal->valid()) {
            $this->headers = $this->internal->current();
            $this->internal->next();
        }
    }
}

