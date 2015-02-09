<?php

namespace Popy\Csv\Writer;

use Popy\Csv\Writer;
use Popy\Csv\Options;

/**
 * Base Writer wrapper class
 */
abstract class AbstractWriterWrapper implements Writer {
    /**
     * Internal Writer
     * 
     * @var Writer
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
    public function appendRow($row)
    {
        $this->internal->appendRow($row);
        return $this;
    }
}