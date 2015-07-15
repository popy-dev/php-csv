<?php

namespace Popy\Csv\Reader;

use Iterator;

/**
 * AbstractIteratorWrapper.
 */
class SkipEmptyLines extends AbstractIteratorWrapper
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
    public function rewind()
    {
        $this->internal->rewind();

        if ($this->internal->valid() && $this->isInternalCurrentEmpty()) {
            $this->next();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        do {
            $this->internal->next();
        } while (
            $this->internal->valid() && $this->isInternalCurrentEmpty()
        );
    }

    /**
     * Checks if the current value of the internal iterators is an empty line.
     *
     * @return boolean
     */
    protected function isInternalCurrentEmpty()
    {
        $current = $this->internal->current();

        return count($current) === 1 && reset($current) === null;
    }
}
