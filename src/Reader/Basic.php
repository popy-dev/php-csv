<?php

namespace Popy\Csv\Reader;

use Popy\Csv\Reader;
use Popy\Csv\DataReader;
use Popy\Csv\Options;

/**
 * Basic CSV Reader implementation.
 */
class Basic implements Reader
{
    /**
     * Data reader.
     *
     * @var Reader
     */
    protected $reader;

    /**
     * CSV Options.
     *
     * @var Options
     */
    protected $options;

    /**
     * internal row counter.
     *
     * @var integer
     */
    protected $key;

    /**
     * Current row.
     *
     * @var array|null
     */
    protected $current;

    /**
     * Class constructor.
     *
     * @param Reader  $reader  Data reader
     * @param Options $options CSV Options
     */
    public function __construct(DataReader $reader, Options $options)
    {
        $this->reader = $reader;
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->key = -1;
        $this->current = null;

        if ($this->reader->isSeekable()) {
            $this->reader->seek(0);
        }

        $this->next();
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        if ($this->reader->eof()) {
            $this->current = null;
            $this->key = null;
        } else {
            $this->current = $this->reader->getcsv(
                $this->options->getDelimiter(),
                $this->options->getEnclosure(),
                $this->options->getEscape()
            );

            $this->key++;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return $this->current !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->key;
    }
}
