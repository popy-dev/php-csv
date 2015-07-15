<?php

namespace Popy\Csv\Reader;

use Iterator;
use Popy\Csv\Reader;

/**
 * AutoNamedColumn Reader : wraps a CSV reader and uses the first row as header list.
 */
class AutoNamedColumn extends NamedColumn
{
    /**
     * Class constructor.
     *
     * @param Iterator $internal Internal iterator
     */
    public function __construct(Iterator $internal)
    {
        $this->internal = $internal;
    }

    /**
     * {@inheritDoc}
     */
    public function getHeaders()
    {
        if ($this->headers === null) {
            $this->rewind();
        }

        return $this->headers;
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
