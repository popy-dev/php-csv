<?php

namespace Popy\Csv\Reader;

use Popy\Csv\Reader;
use Popy\Csv\Options;

/**
 * AbstractReaderWrapper
 */
abstract class AbstractReaderWrapper implements Reader {
    /**
     * Internal Reader
     * 
     * @var Reader
     */
    protected $internal;

    /**
     * Class destructor
     */
    public function __destruct()
    {
        $this->internal = null;
    }

    /**
     * {@inheritDoc}
     */
    public function setOptions(Options $options)
    {
        return $this->internal->setOptions($options);
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        return $this->internal->getOptions();
    }

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
        $row = $this->internal->current();
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->internal->key();
    }
}

