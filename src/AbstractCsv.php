<?php

namespace Popy\Csv;

/**
 * Helper class
 */
class AbstractCsv implements Csv
{
    /**
     * Csv option container
     * 
     * @var Options
     */
    protected $options;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->options = new Options();
    }

    /**
     * {@inheritDoc}
     */
    public function setOptions(Options $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        return $this->options;
    }
}