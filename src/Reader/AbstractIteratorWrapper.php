<?php

namespace Popy\Csv\Reader;

use Iterator;
use Popy\Csv\Reader;

/**
 * AbstractIteratorWrapper.
 */
abstract class AbstractIteratorWrapper implements Reader
{
    /**
     * Internal iterator.
     *
     * @var Iterator
     */
    protected $internal;

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->internal->rewind();
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        $this->internal->next();
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return $this->internal->valid();
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->internal->current();
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->internal->key();
    }
}
